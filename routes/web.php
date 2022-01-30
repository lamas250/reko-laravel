<?php




Route::get('login', function () {
  return view('auth.login');
})->name('login');
Route::post('login', 'UserController@login')->name('loginWeb');


Route::group(['middleware' => ['auth']], function () {
  Route::get('perfil', 'UserController@perfil')->name('perfil');
  Route::get('perfisUsuario', 'UserController@listProfiles')->name('perfisUsuario');
  Route::post('perfil', 'UserController@setPerfil')->name('perfilWeb');

  Route::get('logout', 'UserController@logout')->name('logout');

  Route::get('/', 'VeltrixController@paginaInicial')->name('index');




  // Projetos
  Route::get('projetos','Admin\ProjetosController@index')->name('projetos.index');
  Route::post('projetos/list', 'Admin\ProjetosController@projetosListar')->name('projetos.listar');
  Route::post('projetos','Admin\ProjetosController@store')->name('projetos.salvar');
  Route::get('projetos/{id}','Admin\ProjetosController@acessar')->name('projetos.acessar');

  // Beneficiados do projeto
  Route::group(['prefix'=>'beneficiados','as' => 'beneficiados.'],function(){
    Route::post('list','Admin\BeneficiadosController@list')->name('list');
  });


  // Acoes Esportivas
  Route::group(['prefix'=>'acoes-esportivas','as' => 'acoes.'],function(){
    Route::post('/list','Admin\SportActionController@list')->name('list');
    Route::get('/{id}', 'Admin\SportActionController@show')->name('show');


    // EVENTOS da ACAO ESPORTIVA
    Route::group(['prefix'=>'eventos','as' => 'eventos.'],function(){
      Route::post('list','Admin\EventosController@list')->name('list');
    });
  });

  Route::get('{any}', 'VeltrixController@index');
});