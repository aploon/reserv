<?php

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

Route::get('/', function () {
    return view('index');
})->middleware(['auth'])->name('dashboard');

Route::get('materiel', [MaterielController::class, 'index'])->name('materiel');

Route::get('reservation', [ReservationController::class, 'index'])->name('reservation');

require __DIR__.'/auth.php';
