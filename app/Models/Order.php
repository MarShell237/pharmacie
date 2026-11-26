<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['admin_id', 'handle_at', 'paid_at', 'delivered_at'])]
class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function prescription(){
        return $this->hasOne(Prescription::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
