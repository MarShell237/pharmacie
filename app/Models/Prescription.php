<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function admin(){
        return $this->belongsTo(User::class, 'validated_by_id');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
