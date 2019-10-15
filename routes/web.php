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

Route::get('set_deputados', 'PoliticosController@set_deputados');
Route::get('set_verbas', 'PoliticosController@set_verbas');

// Route::get('teste', 'PoliticosController@teste');