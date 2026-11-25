<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\traits\HasFile;

#[Fillable(['validated_by_id', 'validated_at', 'rejected_at'])]
class Prescription extends Model
{
    use HasFactory, HasFile;

    protected function fileColumn(): string
    {
        return 'scan_url';
    }

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
