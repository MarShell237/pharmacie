<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::whereNotNull('paid_at')->each(function($order){
            Payment::factory()->for($order, 'order')->create([
                'merchant_reference' => 'ORDER' . $order->id . time()
            ]);
        });
    }
}
