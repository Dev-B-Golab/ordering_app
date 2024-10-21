<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DOMDocument;
use DOMXPath;


class RestaurantsApi extends Controller
{
    public function fetchRestaurantData($url = null){
        {
            if($url != null){
                $response = Http::get($url);
        
                if ($response->successful()) {
                    $data = $response->json();

                    if($data != NULL){
                        $praseData = $this->praseJsonPod8($data);
                    }
              
                    return $praseData;
                } else {
                    return response()->json(['error' => 'Failed to fetch data'], $response->status());
                }
            }
        }
    }
    private function praseJsonPod8($data){
        $praseList = [];
        
        $result = $data['result'];
        
        $praseList['name'] = $result['name'];
        $praseList['order_nr'] = $result['order_phone_numbers'][0];
        $praseList['min_order_val'] = $result['min_order_value_with_pickup'];
        
        foreach($result['catalogue']['categories'] as $key => $value){
            $praseList['categories'][] = [
                'id' => $key,
                'category_name' => $value['name'],
            ];
        }
        foreach($result['catalogue']['products'] as $key => $value){
            $praseList['menu_positions'][] = [
                'id' => $key,
                'position_name' => $value['name']['pl'],
                // 'position_values' => $value['price']['values'],
                'position_values' => [
                    0 => $value['price']['values'][0][1],
                    1 => $value['price']['values'][1][1] ?? '',
                ],
                'position_category' => $value['category'],
            ];
            
        }

        return $praseList;
    }
}
