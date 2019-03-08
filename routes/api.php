<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/user' => 'API\UserController'
]);

Route::apiResources([
    '/membro' => 'API\MembroController'
]);

Route::apiResources([
    '/contato' => 'API\ContatoController'
]);

Route::get( 'profile', 'API\UserController@profile');
Route::get( '/contato/{origem}/{tipo}/{id}', 'API\ContatoController@index');

Route::get( 'membro/escolariadade/{id}', 'API\MembroController@getEscolaridade');
Route::post( 'membro/escolariadade', 'API\MembroController@createEscolaridade');
Route::put( 'membro/escolariadade/{id}', 'API\MembroController@saveEscolaridade');

Route::get( 'membro/endereco/{id}', 'API\MembroController@getEndereco');
Route::post( 'membro/endereco', 'API\MembroController@createEndereco');
Route::put( 'membro/endereco/{id}', 'API\MembroController@saveEndereco');
