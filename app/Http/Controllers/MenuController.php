<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use DOMDocument;
use DOMXPath;

class MenuScrapingController extends Controller
{
    public function index()
    {
        // Pobierz HTML strony
        $url = 'https://restaurant.com/menu'; // URL strony restauracji, z której chcesz scrapować menu
        $response = Http::get($url);

        // Sprawdź, czy odpowiedź jest prawidłowa
        if ($response->failed()) {
            return Inertia::render('Menu', [
                'error' => 'Nie udało się załadować menu'
            ]);
        }

        // Pobierz zawartość HTML
        $html = $response->body();

        // Tworzymy nowy obiekt DOMDocument i załadowujemy HTML
        $dom = new DOMDocument();
        @$dom->loadHTML($html);  // '@' ignoruje błędy, jeśli HTML jest niepoprawny

        // Używamy DOMXPath do nawigacji po HTML
        $xpath = new DOMXPath($dom);

        // Tutaj dostosuj zapytanie XPath do struktury HTML strony restauracji
        // Zakładamy, że pozycje menu są w <div class="menu-item">
        $items = $xpath->query('//div[@class="menu-item"]');

        $menu = [];

        // Przetwarzamy elementy menu
        foreach ($items as $item) {
            $name = $xpath->query('.//span[@class="item-name"]', $item)->item(0)->textContent ?? 'Brak nazwy';
            $price = $xpath->query('.//span[@class="item-price"]', $item)->item(0)->textContent ?? 'Brak ceny';

            $menu[] = [
                'name' => $name,
                'price' => $price,
            ];
        }

        // Przekazanie danych do Vue przez Inertia
        return Inertia::render('Menu', [
            'menu' => $menu,
        ]);
    }
}
