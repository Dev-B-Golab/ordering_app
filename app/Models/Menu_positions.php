<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_position extends Model
{
    use HasFactory;

    // Określenie, które pola są masowo przypisywalne
    protected $fillable = [
        'id_restaurant',
        'name',
        'ingredients',
        'size',
        'price',
    ];

    /**
     * Relacja z modelem Restaurant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }
}