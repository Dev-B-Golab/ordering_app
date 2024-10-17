<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_position extends Model
{
    use HasFactory;

    // Określenie, które pola są masowo przypisywalne
    protected $fillable = [
        'id_user',
        'id_menu',
        'id_order',
        'price',
    ];

    /**
     * Relacja z modelem User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relacja z modelem MenuPosition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuPosition()
    {
        return $this->belongsTo(MenuPosition::class, 'id_menu');
    }

    /**
     * Relacja z modelem Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
