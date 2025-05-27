<?php

use App\Http\Controllers\AdminShipController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ShipController;
use Illuminate\Support\Facades\Route;
use App\Models\Ship;

// Public routes
Route::get('/', function () {
    $featuredShips = Ship::where('featured', true)->take(6)->get();
    return view('welcome', compact('featuredShips'));
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/ships', [ShipController::class, 'index'])->name('ships.index');
Route::get('/ships/{ship}', [ShipController::class, 'show'])->name('ships.show');

// Group 1: Role-based routes
Route::middleware(['auth'])->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-shipments', [CargoController::class, 'index'])->name('cargos.index');
    Route::resource('cargos', CargoController::class)->except(['index']);

    Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image.update');
});

Route::middleware(['auth', 'editor'])->group(function () {
    Route::resource('/schedules', ScheduleController::class)->except(['show']);
    Route::get('/schedules/data', [ScheduleController::class, 'dataTable'])->name('schedules.datatable');
    Route::put('shipping-schedules/{id}', [ScheduleController::class, 'update'])
     ->name('shipping-schedules.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('ships', \App\Http\Controllers\AdminShipController::class);
});

Route::get('/test-admin', function () {
    return 'Admin access granted!';
})->middleware('admin');

Route::get('/test-editor', function () {
    return 'Editor access granted!';
})->middleware('editor');

Route::middleware('auth')->group(function () {
    
});

require __DIR__.'/auth.php';
