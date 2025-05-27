<?php

namespace Database\Seeders;

use App\Models\ShippingSchedule;
use App\Models\Ship;
use App\Models\Port;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShippingScheduleSeeder extends Seeder
{
    public function run()
    {
        $ships = Ship::all();
        $ports = Port::all();

        foreach ($ships as $ship) {
            ShippingSchedule::create([
                'ship_id' => $ship->id,
                'departure_port_id' => $ports->random()->id,
                'arrival_port_id' => $ports->random()->id,
                'departure_time' => Carbon::now()->addDays(rand(1, 30)),
                'arrival_time' => Carbon::now()->addDays(rand(31, 60)),
            ]);
        }
    }
}