<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(){
        return Inertia::render('Menu', [

        ]);
    }

    // public function showOrder(){
    //     return Inertia::render('Menu', [
    //     ]);
    // }
    public function orderHistory(){
        return Inertia::render('Menu', [
        ]);
    }
}
