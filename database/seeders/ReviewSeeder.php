<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <= rand(68, 165); $i++){
            $user = User::role(UserRole::CUSTOMER->value)->inRandomOrder()->first();
            Review::factory()->for($user, 'user')->create();
        }
    }
}
