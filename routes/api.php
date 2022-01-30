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



// Auth route public
Route::post('/login','Api\Auth\AuthController@login')->name('api-login');

Route::get('/ping', function(){
  return response()->json('PONG');
});

Route::get('/turmas-favotiras', 'Api\TurmasController@listarFavoritas');



// // Turmas
// Route::group(['prefix' => 'turmas'], function(){
//   Route::get('{id}','Eventos');
// });

// Eventos
Route::group(['prefix' => 'eventos'], function(){
  Route::get('{id}','Api\EventosController@listarEventos');
  Route::get('/listar-beneficiados/{id}','Api\EventosController@listarBeneficiados');
  Route::post('/comparar','Api\EventosController@compararBeneficiado');
});


