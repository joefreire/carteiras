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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();

Route::get('/', 'Controller@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::any('/carteiras', 'HomeController@carteiras')->name('carteiras');
Route::get('/carteira/nova', 'HomeController@novaCarteira')->name('novaCarteira');
Route::any('/carteira/resultados', 'HomeController@resultados')->name('resultados');
Route::post('/carteira/salva', 'HomeController@salvaCarteira')->name('salvaCarteira');
Route::post('/carteira/check', 'HomeController@checkCarteira')->name('checkCarteira');

