<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'stock',
        'price',
        'description',
        'image',
    ];
    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function Carts(){ 
        return $this->hasMany(Cart::class,'cart_id','id');
    }
}
