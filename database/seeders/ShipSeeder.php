<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    public function run()
    {
        $ships = [
            ['name' => 'Ocean Pioneer', 'type' => 'Container Ship', 'capacity' => 20000, 'featured' => true],
            ['name' => 'Blue Horizon', 'type' => 'Bulk Carrier', 'capacity' => 50000],
            ['name' => 'Golden Wave', 'type' => 'Tanker', 'capacity' => 300000],
            ['name' => 'Northern Star', 'type' => 'LNG Carrier', 'capacity' => 150000],
            ['name' => 'Southern Cross', 'type' => 'Ro-Ro', 'capacity' => 8000],
            ['name' => 'Pacific Queen', 'type' => 'Cruise Ship', 'capacity' => 5000],
            ['name' => 'Atlantic Runner', 'type' => 'Container Ship', 'capacity' => 25000],
            ['name' => 'Mediterranean Glory', 'type' => 'Bulk Carrier', 'capacity' => 60000],
            ['name' => 'Arctic Explorer', 'type' => 'Icebreaker', 'capacity' => 10000],
            ['name' => 'Caribbean Dream', 'type' => 'Container Ship', 'capacity' => 22000],
        ];

        foreach ($ships as $ship) {
            Ship::create($ship);
        }
    }
}