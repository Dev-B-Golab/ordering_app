<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_token',
        'user_id_admin',
        'restaurant_id',
        'end_time',
        'private',
    ];


    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id_admin');
    }

    public function orderPositions()
    {
        return $this->hasMany(Restaurants::class, 'restaurant_id');
    }
}
