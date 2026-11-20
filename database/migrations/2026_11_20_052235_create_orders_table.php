<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            // $table->foreignId('admin_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('delivery_fee')->nullable();
            $table->string('delivery_adress')->nullable();
            // $table->string('parcel_image')->nullable();
            // $table->string('receipt_image')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('ship_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
