<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ])
        ->assignRole(Role::firstWhere('name', UserRole::ADMIN->value));
        $user->registration_number = "PHARMACIE-" . $user->id;
        $user->save();
        $this->call([
            CustomerSeeder::class,
        ]);
    }
}
