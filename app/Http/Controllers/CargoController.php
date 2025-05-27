<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Ship;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $cargos = auth()->user()->cargos()->with('ship')->paginate(10);
        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        $ships = Ship::all();
        return view('cargos.create', compact('ships'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'weight' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'ship_id' => 'required|exists:ships,id'
        ]);

        auth()->user()->cargos()->create($validated);

        return redirect()->route('cargos.index')
            ->with('success', 'Shipment created successfully');
    }

    public function edit(Cargo $cargo)
    {
        $this->authorize('update', $cargo);
        $ships = Ship::all();
        return view('cargos.edit', compact('cargo', 'ships'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $this->authorize('update', $cargo);
        
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'weight' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'ship_id' => 'required|exists:ships,id'
        ]);

        // Use forceFill to bypass mass assignment protection
        $cargo->forceFill($validated)->save();

        return redirect()->route('cargos.index')
            ->with('success', 'Shipment updated successfully');
    }

    public function destroy(Cargo $cargo)
    {
        $this->authorize('delete', $cargo);
        $cargo->delete();
        return redirect()->route('cargos.index')
            ->with('success', 'Shipment deleted successfully');
    }
}
