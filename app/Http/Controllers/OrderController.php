<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_positions;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('CreateOrder', [
        ]);
    }

    public function store(Request $request){
        // dd($request);
        try{
            $date = date("Y-m-d H:i:s");
            $is_private = $request['private'] == true ? 1 : 0;
            // dd($is_private);

            $order = new Order([
                'user_id_admin' => Auth::id(),
                'restaurant_id' => $request['restaurant'],
                'end_time' => $request['end_time'],
                'private' => $is_private,
            ]);
            $order->save();
    
            $orderkey = $this->getOrderKey($order->id);
    
            $order->update([
                'order_token' => $orderkey,
            ]);
            return Inertia::location(route('menu', ['token' => $orderkey]));
        }
        catch (Exception $e) {
            return response()->json(['error' => [$e->getMessage()]], 500);
        }
    }

    public function orderHistory(){
        return Inertia::render('Menu', [
        ]);
    }

    private function getOrderKey($id){

        $key =  strtoupper(substr(md5($id . 'cncsoft' . time()), 0, 20));
        $key = preg_replace('/[^A-Z0-9_]/', '_', $key);
        return $key;

    }
}
