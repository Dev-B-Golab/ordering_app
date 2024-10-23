<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_position extends Model
{
    use HasFactory;

    // Określenie, które pola są masowo przypisywalne
    protected $fillable = [
        'id_order',
        'user_id',
        'positions',
        'price',
    ];

    /**
     * Relacja z modelem User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
