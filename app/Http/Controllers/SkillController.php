<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('view-skill');

        $query = Skill::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $skills = $query->paginate(20);

        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-skill');

        return view('skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-skill');

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills,name',
            'description' => 'nullable|string|max:255',
        ]);

        Skill::create($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        Gate::authorize('view-skill');

        return view('skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        Gate::authorize('edit-skill');

        return view('skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        Gate::authorize('edit-skill');

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills,name,' . $skill->id,
            'description' => 'nullable|string|max:255',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        Gate::authorize('delete-skill');

        $skill->delete();

        return redirect()->route('skills.index')
            ->with('success', 'Skill deleted successfully.');
    }
}
