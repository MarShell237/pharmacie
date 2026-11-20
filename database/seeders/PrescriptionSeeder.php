<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Order;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_count = Order::all()->count();
        $orders = Order::inRandomOrder()
                        ->limit(rand(1, $order_count))
                        ->get();
        foreach($orders as $order){
            $user = User::role(UserRole::CUSTOMER->value)->inRandomOrder()->first();
            Prescription::factory()->for($user, 'customer')->for($order, 'order')->create();
        }
    }
}
