<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // user test
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password')
        ])
        ->assignRole(Role::firstWhere('name', UserRole::CUSTOMER->value));

        User::factory(15)
            ->create()
            ->each(function (User $user) {
                $user->assignRole(Role::firstWhere('name', UserRole::CUSTOMER->value));
            });

    }
}
