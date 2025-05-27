<?php

namespace App\Http\Controllers;

use App\Models\ShippingSchedule;
use App\Models\Ship;
use App\Models\Port;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('editor');
    }

    
    public function dataTable()
    {
        $schedules = ShippingSchedule::with(['ship', 'departurePort', 'arrivalPort'])
            ->select('shipping_schedules.*');

        return DataTables::eloquent($schedules)
            ->addColumn('ship.name', function($schedule) {
                return $schedule->ship->name ?? 'N/A';
            })
            ->addColumn('departure_port.name', function($schedule) {
                return $schedule->departurePort->name ?? 'N/A';
            })
            ->addColumn('arrival_port.name', function($schedule) {
                return $schedule->arrivalPort->name ?? 'N/A';
            })
            ->addColumn('action', function($schedule) {
                return view('components.datatable-actions', [
                    'editRoute' => route('schedules.edit', $schedule),
                    'deleteRoute' => route('schedules.destroy', $schedule),
                ])->render();
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        $ships = Ship::with(['shippingSchedules' => function($query) {
            $query->whereNotNull('price')
                ->orderBy('departure_time', 'desc');
        }])->whereHas('shippingSchedules', function($query) {
            $query->whereNotNull('price');
        })->get();

        $chartData = $ships->map(function($ship) {
            return [
                'name' => $ship->name,
                'price' => $ship->shippingSchedules->avg('price')
            ];
        });

        return view('schedules.index', [
            'ships' => $ships,
            'chartData' => $chartData
        ]);
    }
    public function edit(ShippingSchedule $schedule)
    {
        $ships = Ship::all();
        $ports = Port::all();
        return view('schedules.edit', compact('schedule', 'ships', 'ports'));
    }

    public function update(Request $request, $id) // Use explicit ID parameter
    {
        // Find model manually
        $shippingSchedule = ShippingSchedule::findOrFail($id);
        
        // Validate
        $validated = $request->validate([
            'ship_id' => 'required|exists:ships,id',
            'departure_port_id' => 'required|exists:ports,id',
            'arrival_port_id' => 'required|exists:ports,id|different:departure_port_id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0'
        ]);

        // Manual update
        $shippingSchedule->update([
            'ship_id' => $validated['ship_id'],
            'departure_port_id' => $validated['departure_port_id'],
            'arrival_port_id' => $validated['arrival_port_id'],
            'departure_time' => $validated['departure_time'],
            'arrival_time' => $validated['arrival_time'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully!');
    }

    public function destroy(ShippingSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully');
    }
}