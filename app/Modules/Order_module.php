<?php

namespace App\Modules;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Restaurans;

class order_module{
    
    public function getDataForMenu($token){
        $result = DB::table('orders')
            ->leftJoin('restaurants', 'orders.id_restaurant', '=', 'restaurants.id')
            ->where('orders.order_token', $token)
            ->get();
        $data = $result->toArray();
        
        return $data[0];
    }
    
}
