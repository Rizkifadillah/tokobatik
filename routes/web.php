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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pesan/{id}', 'PesanController@index');
Route::post('/pesan/{id}', 'PesanController@pesan');
Route::get('/checkout', 'PesanController@checkout');
Route::delete('/checkout/{id}', 'PesanController@delete');

Route::get('/konfirmasi-checkout', 'PesanController@konfirmasi');

Route::get('/profil', 'ProfilController@index');
Route::post('/profil', 'ProfilController@update');

Route::get('/history', 'HistoryController@index');
Route::get('/history/{id}', 'HistoryController@detail');
