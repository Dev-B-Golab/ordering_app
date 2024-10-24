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
            $priceValues = $value['price']['values'];
            $multipliedPrice0 = isset($priceValues[0][1]) ? $priceValues[0][1] * 100 : '';
            $multipliedPrice1 = isset($priceValues[1][1]) ? $priceValues[1][1] * 100 : '';
            $praseList['menu_positions'][] = [
                'id' => $key,
                'position_name' => $value['name']['pl'],
                'options' => [
                    'price' => [
                        0 => $multipliedPrice0,
                        1 => $multipliedPrice1,
                    ],
                    'size' => [
                        0 => 'Mały',
                        1 => 'Duży', // TODO: zmienic na pobieranie z api ilosc rozmiarow i cene 
                    ],
                ],
                'position_category' => $value['category'],
                'description' => $value['description']
            ];
        }
        foreach ($praseList['menu_positions'] as $key => &$value) {
            sort($value['options']['price']); 
        }

        usort($praseList['menu_positions'], function($a, $b) {
            $parseName = function($name) {
                if (preg_match('/^(\d+)\.\s*(.*)$/', $name, $matches)) {
                    return [(int)$matches[1], $matches[2]];
                }
                return [null, $name];
            };
        
            list($numA, $textA) = $parseName($a['position_name']);
            list($numB, $textB) = $parseName($b['position_name']);
        
            if ($numA !== null && $numB !== null) {
                if ($numA != $numB) {
                    return $numA - $numB;
                }
            }
        
            if ($numA !== null && $numB === null) {
                return -1;
            }
            if ($numA === null && $numB !== null) {
                return 1;
            }
        
            return strcmp($textA, $textB);
        });
        return $praseList;
    }
}
