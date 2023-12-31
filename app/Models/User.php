<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes,HasRoles;
    protected $fillable = [
        'number_id',
        'name',
        'last_name',
        'address',
        'cellphone',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password']= bcrypt($value); 
    }
    public function Carts(){ 
        return $this->hasMany(Cart::class,'user_id','id');
    }

}
