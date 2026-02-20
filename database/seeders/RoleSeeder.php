<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);

        // Page specific roles
        Role::firstOrCreate(['name' => 'Leadership Manager']);
        Role::firstOrCreate(['name' => 'Corporate Actions Manager']);
        Role::firstOrCreate(['name' => 'Financial Reports Manager']);
        Role::firstOrCreate(['name' => 'Gallery Manager']);
        Role::firstOrCreate(['name' => 'Viewer']);

        // Create Super Admin user
        $user = User::where('email', 'admin@abujainternationalhotels.com')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'System Admin',
                'email' => 'admin@abujainternationalhotels.com',
                'password' => Hash::make('password'),
            ]);
        }

        $user->assignRole($superAdminRole);
    }
}
