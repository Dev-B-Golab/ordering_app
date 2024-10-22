<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_token',
        'id_admin_order',
        'id_restaurant',
        'end_time',
    ];


    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin_order');
    }

    public function orderPositions()
    {
        return $this->hasMany(Restaurants::class, 'id_restaurant');
    }
}
