<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Admin
        $admin = User::create([
            'name' => 'Agil',
            'email' => 'admin@roles.id',
            'password' => Hash::make('123456')
        ]);
        $admin->assignRole('admin');

        // Membuat Staff / Operator
        $operator = User::create([
            'name' => 'Arta',
            'email' => 'staff@roles.id',
            'password' => Hash::make('123456')
        ]);
        $operator->assignRole('staff');
    }
}
