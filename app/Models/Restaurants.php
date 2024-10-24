<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    use HasFactory;

    // Określenie, które pola są masowo przypisywalne
    protected $fillable = [
        'name',
        'api_url',
    ];

}