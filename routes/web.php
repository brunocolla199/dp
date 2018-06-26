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

    Route::get('/home', 'HomeController@index')->name('home');

    /*
	* BPMN 2.0
	*/
	Route::group(['prefix' => 'bpmn'], function() {
		Route::get('',	       		['as' => 'bpmn', 	        		'uses' => 'BPMN\BPMNController@index']);
		// Route::post('store', 		['as' => 'cargos.store', 		'uses' => 'CargosController@store']);
		// Route::get('{id}/delete', 	['as' => 'cargos.delete', 		'uses' => 'CargosController@delete']);
		// Route::get('{id}/edit', 	['as' => 'cargos.edit', 			'uses' => 'CargosController@edit']);
		// Route::post('update', 		['as' => 'cargos.update', 		'uses' => 'CargosController@update']);
    });
    
    /*
	* DOCUMENTAÇÃO
	*/
	Route::group(['prefix' => 'documentacao'], function() {
		Route::get('',	       		['as' => 'documentacao', 	       	'uses' => 'Documentacao\DocumentacaoController@index']);
    });
    
    /*
	* FORMULÁRIOS
	*/
	Route::group(['prefix' => 'formularios'], function() {
		Route::get('',	       		['as' => 'formularios', 	        	'uses' => 'Formularios\FormulariosController@index']);
	});
	
	

    
	
	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    
});

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

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