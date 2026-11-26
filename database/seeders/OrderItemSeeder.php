<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::all()->each(function($order){
            OrderItem::factory()
            ->count(rand(1, 9))
            // ->for(Product::whereNotNull('published_at')->inRandomOrder()->first(), 'product')
            ->for($order, 'order')
            ->create();
        });
    }
}
