<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Http\Requests\StoreShipRequest;
use App\Http\Requests\UpdateShipRequest;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShipRequest $request)
    {
        //
    }

    public function index()
    {
        $ships = Ship::all();
                    
        return view('ships.all', compact('ships'));
    }

    public function show(Ship $ship)
    {
        
        return view('ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipRequest $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ship $ship)
    {
        //
    }
}
