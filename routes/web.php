<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::resource('materiaux', MaterielController::class)
    ->middleware(['auth']);

Route::get('reservations/mes_reservations', [ReservationController::class, 'mes_reservations'])
->middleware(['auth'])
->name('reservations.mes_reservations');

Route::resource('reservations', ReservationController::class)
    ->only(['index', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::post('reservations/create', [ReservationController::class, 'create'])
    ->middleware(['auth'])
    ->name('reservations.create');

require __DIR__.'/auth.php';
