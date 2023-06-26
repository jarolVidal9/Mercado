<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
    ];
    public function User(){ 
        return $this->belongsToMany(User::class,'user_id','id');
    }
    public function Product(){ 
        return $this->belongsToMany(Product::class,'product_id','id');
    }
}