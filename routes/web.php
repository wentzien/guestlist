<?php

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

//Startseite:
Route::get('/', function () {
    return view('home');
});
//Einstellungen + pers. Texte
Route::get('/settings', function () {
    return view('setting');
});
//Motionerkennung
Route::get('/detection', function () {
    return view('detection');
});
//Slideshow mit Audio-Texten und Aufzeichnung der pers. Daten
Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
