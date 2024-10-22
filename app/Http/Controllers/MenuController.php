<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestaurantsApi;
use Inertia\Inertia;


class MenuController extends Controller
{
    public function index()
    {
        $url = 'https://www.pod8jaslo.pl/api/v1/sites/restaurant_menu/216204/pl?v=ca8d8902323f9e49aae0ac25056a766d';
        $restauranst = new RestaurantsApi();
        $pod8 = $restauranst->fetchRestaurantData($url);
        $test = session();
        // dd($test);
        return Inertia::render('Menu', [
            'menuData' => $pod8,
        ]);
    }
}
