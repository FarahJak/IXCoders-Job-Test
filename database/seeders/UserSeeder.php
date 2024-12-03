<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name'           => 'TestUser',
            'email'          => 'user@test.com',
            'password'       => Hash::make('123456789'),
        ];

        $role = Role::where('name', 'Admin')->first();

        $user  = User::create($user);

        $user->assignRole($role);
    }
}
