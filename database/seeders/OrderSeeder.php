<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = rand(60, 122);

        for ($i = 0; $i < $count; $i++) {
            $user = User::role(UserRole::CUSTOMER->value)->inRandomOrder()->first();
            $order = Order::factory()
                ->for($user, 'user')
                ->create();
            if($order->paid_at) $order->merchant_reference = 'ORDER' . $order->id . time();
        }

    }
}
