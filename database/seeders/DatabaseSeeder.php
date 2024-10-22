<?php

namespace Database\Seeders;

use App\Models\Restaurants;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Restaurants::create([
            'name' => 'Pod 8',
            'api_url' => 'https://www.pod8jaslo.pl/api/v1/sites/restaurant_menu/216204/pl?v=ca8d8902323f9e49aae0ac25056a766d',
        ]);
        Restaurants::create([
            'name' => 'Doner',
            'api_url' => '',
        ]);
        User::create(  [
            'name' => 'test',
            'email' => 'bartekgoab7@gmail.com',
            'password' => 'test123',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s"),
        ]);
}
}
