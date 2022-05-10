<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UsersController;
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

Route::get('materiaux/search', [MaterielController::class, 'search'])
->middleware(['auth'])
->name('materiaux.search');

Route::get('reservations/mes_reservations', [ReservationController::class, 'mes_reservations'])
->middleware(['auth'])
->name('reservations.mes_reservations');

Route::get('reservations/fullcalendar', [ReservationController::class, 'fullcalendar_reserv'])
->middleware(['auth'])
->name('reservations.fullcalendar');

Route::resource('materiaux', MaterielController::class)
    ->middleware(['auth']);

Route::resource('reservations', ReservationController::class)
    ->only(['index', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::post('reservations/create', [ReservationController::class, 'create'])
    ->middleware(['auth'])
    ->name('reservations.create');

Route::get('users', [UsersController::class, 'index'])->name('users.index');

require __DIR__.'/auth.php';
