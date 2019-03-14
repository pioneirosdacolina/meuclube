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
    'user' => 'API\UserController',
    'membro' => 'API\MembroController',
    'responsavel' => 'API\ResponsavelController',
    'contato' => 'API\ContatoController',
    'informacoesAdicionais' => 'API\InformacoesAdicionaisController',
]);


Route::get( 'profile', 'API\UserController@profile');
Route::get( 'contato/{origem}/{tipo}/{id}', 'API\ContatoController@index' );

Route::get( 'membro/escolariadade/{id}', 'API\MembroController@getEscolaridade' );
Route::get( 'membro/endereco/{id}', 'API\MembroController@getEndereco' );

Route::put( 'membro/escolariadade/{id}', 'API\MembroController@saveEscolaridade' );
Route::put( 'membro/endereco/{id}', 'API\MembroController@saveEndereco' );

Route::post( 'membro/endereco', 'API\MembroController@createEndereco' );
Route::post( 'membro/escolariadade', 'API\MembroController@createEscolaridade' );
