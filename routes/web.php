<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes hi
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

  to resolve refs-problems
  git remote prune origin
  rm .git/refs/remotes/origin/master
  git fetch
  git pull origin master
|
*/

Route::get('/wlc', function () {
    return view('welcome');
});
