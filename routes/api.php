<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/games', 'GameController@index');
Route::get('/games/{game}', 'GameController@show');
Route::post('/games', 'GameController@store');
Route::put('/games/{game}', 'GameController@update');
Route::delete('/games/{game}', 'GameController@destroy');

Route::get('/production_blocs', 'ProductionBlocController@index');
Route::get('/production_blocs/{production_bloc}', 'ProductionBlocController@show');
Route::post('/production_blocs', 'ProductionBlocController@store');
Route::put('/production_blocs/{production_bloc}', 'ProductionBlocController@update');
Route::delete('/production_blocs/{production_bloc}', 'ProductionBlocController@destroy');
Route::post('/production_blocs/{production_bloc}/connect/{pd_to_connect}', 'ProductionBlocController@connect');
Route::get('/production_blocs/{production_bloc}/children', 'ProductionBlocController@showChildren');
Route::get('/production_blocs/{production_bloc}/parent', 'ProductionBlocController@showParent');
Route::get('/production_blocs/{production_bloc}/production_unites', 'ProductionBlocController@showProductionUnites');

Route::get('/production_unites/{production_unite}', 'ProductionUniteController@show');
Route::post('/production_unites', 'ProductionUniteController@store');
