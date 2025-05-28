<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('read-employee');

        $employees = Employee::with('skills')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                      ->orWhere('email', 'like', "%{$request->search}%")
                      ->orWhere('position', 'like', "%{$request->search}%");
            })
            ->paginate(10);

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        Gate::authorize('create-employee');

        $skills = Skill::all();
        return view('employee.create', compact('skills'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create-employee');

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:employees,email',
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'position'        => 'nullable|string|max:100',
            'skills'          => 'nullable|array',
            'skills.*'        => 'exists:skills,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = Employee::create(
            collect($validated)->except(['skills', 'profile_picture'])->toArray()
        );

        if ($request->hasFile('profile_picture')) {
            $employee->profile_picture = $this->saveProfilePicture($request);
            $employee->save();
        }

        $employee->skills()->attach($validated['skills'] ?? []);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        Gate::authorize('read-employee');

        $employee->load('skills');
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        Gate::authorize('edit-employee');

        $skills = Skill::all();
        $employeeSkillIds = $employee->skills->pluck('id')->toArray();

        return view('employee.edit', compact('employee', 'skills', 'employeeSkillIds'));
    }

    public function update(Request $request, Employee $employee)
    {
        Gate::authorize('edit-employee');

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:employees,email,' . $employee->id,
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'position'        => 'nullable|string|max:100',
            'skills'          => 'nullable|array',
            'skills.*'        => 'exists:skills,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee->update(
            collect($validated)->except(['skills', 'profile_picture'])->toArray()
        );

        if ($request->hasFile('profile_picture')) {
            if ($employee->profile_picture && Storage::disk('public')->exists($employee->profile_picture)) {
                Storage::disk('public')->delete($employee->profile_picture);
            }

            $employee->profile_picture = $this->saveProfilePicture($request);
            $employee->save();
        }

        $employee->skills()->sync($validated['skills'] ?? []);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        Gate::authorize('delete-employee');

        $employee->skills()->detach();

        if ($employee->profile_picture && Storage::disk('public')->exists($employee->profile_picture)) {
            Storage::disk('public')->delete($employee->profile_picture);
        }

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }

    /**
     * Simpan profile picture ke penyimpanan publik.
     */
    private function saveProfilePicture(Request $request): string
    {
        $file = $request->file('profile_picture');
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('profiles', $filename, 'public');
    }
}
