<?php

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

// Route::get('/', function () {
//     return view('auth/login');
// });

Route::prefix("admin")->middleware(['auth','admin'])->group(function() {
    Route::get('/', 'GuruController@index')->name('admin.home');
    Route::post('/guru/create', 'GuruController@store');
    Route::post('/guru/update/{id}', 'GuruController@update');
    Route::get('/guru/delete/{id}', 'GuruController@destroy');
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@store');
    Route::post('/siswa/update/{id}', 'SiswaController@update');
    Route::get('/siswa/delete/{id}', 'SiswaController@destroy');
    Route::get('/absen-guru', 'AbsenGuruController@index');
    Route::get('/absen-siswa', 'AbsenSiswaController@index');
});

Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/absen/create', 'HomeController@store');  
    Route::post('/absen/change-password/{id}', 'HomeController@update')->name('change.password');  
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
