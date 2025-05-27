<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Ship;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run()
    {
        $cargoTypes = [
            ['type' => 'Electronics'],
            ['type' => 'Machinery'],
            ['type' => 'Petroleum'],
            ['type' => 'Grains'],
            ['type' => 'Vehicles'],
        ];

        $ships = Ship::all();

        foreach ($ships as $ship) {
            // Assign 1-3 cargo items per ship
            $cargoCount = rand(1, 3);
            
            for ($i = 0; $i < $cargoCount; $i++) {
                $cargoType = $cargoTypes[array_rand($cargoTypes)];
                
                Cargo::create([
                    'ship_id' => $ship->id,
                    'type' => $cargoType['type'],
                    'weight' => rand(1000, 50000), // Weight in kg
                ]);
            }
        }
    }
}