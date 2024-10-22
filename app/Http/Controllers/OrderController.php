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
        $date = date("Y-m-d H:i:s");

        $order = new Order([
            'id_admin_order' => Auth::id(),
            'id_restaurant' => $request['restaurant'],
            'end_time' => $request['end_time']
        ]);
        $order->save();

        $orderkey = $this->getOrderKey($order->id);

        $order->update([
            'order_token' => $orderkey,
        ]);
        return response()->json(['message' => ['Dziaua']], 201);
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
