<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\AuthentificationController;

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

Route::get('/wlc', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/materiel', function () {
    return view('materiel');
});

Route::get('/reservation', function () {
    return view('reservation');
});

Route::get('/inscription',[ConnexionController::class,'inscription'])->name('connexion');
Route::post('/inscription',[ConnexionController::class,'traitementFormulaireInscription']);

Route::get('/connexion',[AuthentificationController::class,'connexion']);
Route::post('/connexion',[AuthentificationController::class,'authentification']);


