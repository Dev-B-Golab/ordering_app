<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Określenie, które pola są masowo przypisywalne
    protected $fillable = [
        'order_token',
        'id_admin_order',
        'end_time',
    ];

    /**
     * Relacja z modelem User (administrator).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin_order');
    }

    /**
     * Relacja z model OrderPosition (pozycje zamówienia).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderPositions()
    {
        return $this->hasMany(OrderPosition::class, 'id_order');
    }
}
