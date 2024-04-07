<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultvalue = [
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $manager = User::create(array_merge([
            'name' => 'manager',
            'email' => 'manager@hanz.com',
            'password' => Hash::make('pass1234'),
        ], $defaultvalue));
        
        $staff = User::create(array_merge([
            'name' => 'staff',
            'email' => 'staff@hanz.com',
            'password' => Hash::make('pass1234'),
        ], $defaultvalue));

        $roleManager = Role::create(['name' => 'manager']);
        $roleStaff = Role::create(['name' => 'staff']);

        $manager->assignRole($roleManager);
        $staff->assignRole($roleStaff);
    }
}
