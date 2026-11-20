<?php

namespace App\Models;

use App\traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasFile;

    protected function fileColumn(): string{
        return 'image';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function batche(){
        return $this->belongsTo(Batche::class);
    }
}
