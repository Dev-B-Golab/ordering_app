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
                // Wykonaj zapytanie GET
                $response = Http::get($url);
        
                // Sprawdź, czy odpowiedź jest poprawna
                if ($response->successful()) {
                    // Pobierz dane w formacie JSON
                    $data = $response->json();
        
                    // Wyświetl dane (możesz je wyświetlić w widoku lub w formacie JSON)
                    return $data;
                } else {
                    // W przypadku błędu zwróć komunikat o błędzie
                    return response()->json(['error' => 'Failed to fetch data'], $response->status());
                }
            }
        }
    }
}
