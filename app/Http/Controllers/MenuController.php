<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestaurantsApi;
use App\Modules\Order_module;
use Inertia\Inertia;


class MenuController extends Controller
{
    public function index($token = null)
    {
        try{
            $order_module = new Order_module;
            if($token != null){
                $order_data = $order_module->getDataForMenu($token);

                $restauranst = new RestaurantsApi();
                $result = $restauranst->fetchRestaurantData($order_data->api_url);
            }
            else{
                $order_data = NULL;
                $result = NULL;
            }

            return Inertia::render('Menu', [
                'menuData' => $result,
                'order_data' => $order_data
                ]);

        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return back();
        }
    }
}
