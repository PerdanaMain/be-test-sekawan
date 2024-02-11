<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('auth.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // vehicles routes
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::put('/vehicles/{vId}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vId}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // approval routes
    Route::put('/vehicles/approval/{vId}', [VehicleController::class, 'approval'])->name('vehicles.approval');

    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.destroy');
});