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
})->name('home');

//Einstellungen + pers. Texte
Route::get('/settings', 'SettingController@edit')->name('settings');
Route::put('/settings/update', 'SettingController@update');

//Motionerkennung
Route::get('/welcome/{gastro_name}', 'WelcomeController@show')->name('welcome');
Route::get('/welcome', 'WelcomeController@show')->name('welcome');
//Slideshow mit Audio-Texten und Aufzeichnung der pers. Daten
Route::get('/recording/{gastro_name}', 'RecordingController@show');
Route::get('/recording', 'RecordingController@show')->name('recording');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
