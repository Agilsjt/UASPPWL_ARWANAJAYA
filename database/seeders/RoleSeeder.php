<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat permissions
        $permissions = [
            // User
            'read-user', 'create-user', 'edit-user', 'delete-user',

            // Employee
            'read-employee', 'create-employee', 'edit-employee', 'delete-employee',

            // Skill
            'read-skill', 'create-skill', 'edit-skill', 'delete-skill',

            // Profil Perusahaan
            'read-profil_perusahaan', 'create-profil_perusahaan', 'edit-profil_perusahaan', 'delete-profil_perusahaan',

            // Layanan
            'read-layanan', 'create-layanan', 'edit-layanan', 'delete-layanan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role Admin dan Operator (Staff)
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $operator = Role::firstOrCreate(['name' => 'staff']);

        // Beri semua permission ke Admin
        $admin->syncPermissions(Permission::all());

        // Staff hanya bisa READ (lihat saja)
        $readPermissions = Permission::where('name', 'like', 'read-%')->get();
        $operator->syncPermissions($readPermissions);
    }
}
