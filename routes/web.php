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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::any('/carteiras', 'HomeController@carteiras')->name('carteiras');
Route::get('/teste', function () {

	$carteira = \App\Carteira::where('ano', 2019)->first();
	dd($carteira, $carteira->precoUltimoMes());
});