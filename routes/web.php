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

// TODO realizar corrção das rotas
Route::redirect( "/", "/home" );
Route::redirect( "/js/popper.js.map", "/Dashboard" );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]*)?');
