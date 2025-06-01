<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-user');

        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('create-user');

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create-user');

        $validate = $request->validate([
            'name'     => ['required','string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'roles'    => ['required', 'array']
        ], [
            'name.required'     => 'Nama wajib diisi!',
            'email.required'    => 'Email wajib diisi!',
            'email.unique'      => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password minimal 8 karakter!',
            'password.confirmed'=> 'Password tidak cocok!',
            'roles.required'    => 'Pilih minimal satu role!'
        ]);

        $user = User::create([
            'name'     => $validate['name'],
            'email'    => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        Gate::authorize('view-user');

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('edit-user');

        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('edit-user');

        $validate = $request->validate([
            'name'     => ['required','string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'roles'    => ['required', 'array']
        ], [
            'name.required'     => 'Nama wajib diisi!',
            'email.required'    => 'Email wajib diisi!',
            'email.unique'      => 'Email sudah terdaftar!',
            'password.min'      => 'Password minimal 8 karakter!',
            'password.confirmed'=> 'Password tidak cocok!',
            'roles.required'    => 'Pilih minimal satu role!'
        ]);

        $user->name = $validate['name'];
        $user->email = $validate['email'];

        if (!empty($validate['password'])) {
            $user->password = Hash::make($validate['password']);
        }

        $user->save();
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete-user');

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
