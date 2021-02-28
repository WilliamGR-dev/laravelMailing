<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Config;

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
    $information = Config::get('information');
    return view('home')->with('information', $information['reservation']);
});

Route::get('/reservation', function () {
    return view('reservation');
});

Route::post('/reservation', 'App\Http\Controllers\ReservationController@create');

Route::get('/reservation/confirm/{token}', 'App\Http\Controllers\ReservationController@confirmReservation');

Route::get('/reservation/annulation/{token}', 'App\Http\Controllers\ReservationController@annulationVerification');

Route::post('/reservation/annulation/{token}', 'App\Http\Controllers\ReservationController@deletReservation');
