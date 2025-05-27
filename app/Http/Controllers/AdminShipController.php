<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;

class AdminShipController extends Controller
{
    public function index()
    {
        $ships = Ship::with('cargos')->paginate(10);
        return view('ships.index', compact('ships'));
    }

    public function create()
    {
        return view('ships.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $ship = new Ship($validated);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ships', 'public');
            $ship->image_path = $path;
        }
    
        $ship->save();
    
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship created successfully');
    }
    
    public function edit(Ship $ship)
    {
        return view('ships.edit', compact('ship'));
    }
    
    public function update(Request $request, Ship $ship)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $ship->fill($validated);
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($ship->image_path) {
                Storage::delete('public/' . $ship->image_path);
            }
            
            $path = $request->file('image')->store('ships', 'public');
            $ship->image_path = $path;
        }
    
        $ship->save();
    
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship updated successfully');
    }

    public function destroy(Ship $ship)
    {
        $ship->delete();
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship deleted successfully');
    }
}