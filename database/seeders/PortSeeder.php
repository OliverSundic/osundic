<?php

namespace Database\Seeders;

use App\Models\Port;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    public function run()
    {
        $ports = [
            ['name' => 'Port of Shanghai', 'location' => 'China', 'capacity' => 500],
            ['name' => 'Port of Singapore', 'location' => 'Singapore', 'capacity' => 400],
            ['name' => 'Port of Rotterdam', 'location' => 'Netherlands', 'capacity' => 350],
            ['name' => 'Port of Busan', 'location' => 'South Korea', 'capacity' => 300],
            ['name' => 'Port of Hamburg', 'location' => 'Germany', 'capacity' => 280],
            ['name' => 'Port of Los Angeles', 'location' => 'USA', 'capacity' => 450],
            ['name' => 'Port of Dubai', 'location' => 'UAE', 'capacity' => 320],
            ['name' => 'Port of Sydney', 'location' => 'Australia', 'capacity' => 250],
            ['name' => 'Port of Santos', 'location' => 'Brazil', 'capacity' => 200],
            ['name' => 'Port of Mumbai', 'location' => 'India', 'capacity' => 180],
        ];

        foreach ($ports as $port) {
            Port::create($port);
        }
    }
}