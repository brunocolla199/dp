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

Route::group(['middleware' => ['auth']], function() {

	/*
	* Rota Principal
	*/
	Route::get('/', function () {
		return Redirect::to('/login');
	});

	// Route::get('/home', 'VinculacoesController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    /*
	* CREDENCIAMENTO
	*/
	Route::group(['prefix' => 'credenciamento'], function() {
		Route::get('',	       		['as' => 'credenciamento', 	        	'uses' => 'Credenciamento\CredenciamentoController@index']);
		// Route::post('store', 		['as' => 'cargos.store', 		'uses' => 'CargosController@store']);
		// Route::get('{id}/delete', 	['as' => 'cargos.delete', 		'uses' => 'CargosController@delete']);
		// Route::get('{id}/edit', 	['as' => 'cargos.edit', 		'uses' => 'CargosController@edit']);
		// Route::post('update', 		['as' => 'cargos.update', 		'uses' => 'CargosController@update']);
    });
    
    /*
	* RELATÓRIOS
	*/
	Route::group(['prefix' => 'relatorios'], function() {
		Route::get('',	       		['as' => 'relatorios', 	        	    'uses' => 'Relatorios\RelatoriosController@index']);
    });
    
    /*
	* INTEGRAÇÕES
	*/
	Route::group(['prefix' => 'integracoes'], function() {
		Route::get('',	       		['as' => 'integracoes', 	        	'uses' => 'Integracoes\IntegracoesController@index']);
	});
    
    /*
	* AUDITORIA
	*/
	Route::group(['prefix' => 'auditoria'], function() {
		Route::get('',	       		['as' => 'auditoria', 	        	    'uses' => 'Auditoria\AuditoriaController@index']);
	});




    
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
	
	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// LogOut
Route::get('/logout', function()
{
	Auth::logout();
	Session::flush();
	return Redirect::to('/login');
});
