<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ])
        ->assignRole(Role::firstWhere('name', UserRole::ADMIN->value));
        $admin->registration_number = "PHARMACIE-" . $admin->id . time();
        $admin->save();

        User::factory(8)
            ->create()
            ->each(function (User $admin) {
                $admin->assignRole(Role::firstWhere('name', UserRole::ADMIN->value));
                $admin->registration_number = "PHARMACIE-" . $admin->id . time();
                $admin->save();
            });
    }
}
