<?php

use App\Models\Order;
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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('validated_by_id')->nullable()->constrained('users');
            $table->string('patient_full_name');
            $table->integer('patient_age');
            $table->string('doctor_name');
            $table->string('doctor_license');
            $table->date('prescribed_at');
            $table->date('expires_at');
            $table->string('scan_url');
            $table->string('scan_hash');
            $table->timestamp('validated_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejected_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
