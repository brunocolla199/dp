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
	* Rotas para requisições AJAX
	*/
	Route::get('ajax/usuarios/retornarUsuarios',  		['as' => 'retornarUsuarios', 	  						'uses' => 'AjaxController@getUsers']);
	Route::post('ajax/usuarios/trocarSetor',  			['as' => 'ajax.usuarios.trocarSetor', 	  				'uses' => 'AjaxController@trocarSetor']);
	Route::post('ajax/usuarios/removerDoGrupo',			['as' => 'ajax.usuarios.removerDoGrupo', 	  			'uses' => 'AjaxController@removerDoGrupo']);
	Route::get('ajax/setores/retornarSetores',  		['as' => 'retornarSetores', 	  						'uses' => 'AjaxController@getSectors']);
	Route::post('ajax/setores/retornaSetoresExcetoUm',  ['as' => 'ajax.setores.retornaSetoresExcetoUm',			'uses' => 'AjaxController@retornaSetoresExcetoUm']);
	Route::post('ajax/upload',                          ['as' => 'ajax.upload.image',	                		'uses' => 'AjaxController@uploadEditorImage']);


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
		Route::get('',	       					['as' => 'documentacao', 	       						'uses' => 'Documentacao\DocumentacaoController@index']);
		Route::post('validate-data',       		['as' => 'documentacao.validate-data', 	    			'uses' => 'Documentacao\DocumentacaoController@validateData']);
		Route::post('save-attached-document',   ['as' => 'documentacao.save-attached-document', 	    'uses' => 'Documentacao\DocumentacaoController@saveAttachedDocument']);
		Route::post('save-new-document',        ['as' => 'documentacao.save-new-document', 	            'uses' => 'Documentacao\DocumentacaoController@saveNewDocument']);
		Route::post('view-document',   			['as' => 'documentacao.view-document', 	    			'uses' => 'Documentacao\DocumentacaoController@viewDocument']);
		Route::post('save-edited-document',   	['as' => 'documentacao.save-edited-document', 	    	'uses' => 'Documentacao\DocumentacaoController@saveEditDocument']);
		Route::post('filter-documents-index',  	['as' => 'documentacao.filter-documents-index',	    	'uses' => 'Documentacao\DocumentacaoController@filterDocumentsIndex']);
		Route::get('make-doc/{doc}',  	        ['as' => 'documentacao.make-doc',	                    'uses' => 'Documentacao\DocumentacaoController@makeDocumentPdf']);
		Route::post('approval-document',  		['as' => 'documentacao.approval-document',	    		'uses' => 'Documentacao\DocumentacaoController@approvalDocument']);
		Route::post('reject-document',  		['as' => 'documentacao.reject-document',	    		'uses' => 'Documentacao\DocumentacaoController@rejectDocument']);
		Route::post('resend-document',  		['as' => 'documentacao.resend-document',	    		'uses' => 'Documentacao\DocumentacaoController@resendDocument']);

	});
    
    /*
	* FORMULÁRIOS
	*/
	Route::group(['prefix' => 'formularios'], function() {
		Route::get('',	       		          ['as' => 'formularios', 	        	          'uses' => 'Formularios\FormulariosController@index']);
		Route::post('validate-data',          ['as' => 'formularios.validate-data',	          'uses' => 'Formularios\FormulariosController@validateData']);
		Route::post('view-formulario',	      ['as' => 'formularios.view-formulario', 	      'uses' => 'Formularios\FormulariosController@viewForm']);
		Route::post('filter-forms-index',     ['as' => 'formularios.filter-forms-index',      'uses' => 'Formularios\FormulariosController@filterFormsIndex']);
		Route::post('save-edited-form',       ['as' => 'formularios.save-edited-form',        'uses' => 'Formularios\FormulariosController@saveEditForm']);
		Route::post('save-new-form',	      ['as' => 'formularios.save-new-form', 	      'uses' => 'Formularios\FormulariosController@saveNewForm']);
		Route::post('save-attached-document', ['as' => 'formularios.save-attached-document',  'uses' => 'Formularios\FormulariosController@saveAttachedDocument']);
	});

	/*
	* CONFIGURAÇÕES
	*/
	Route::group(['prefix' => 'configuracoes'], function() {
		Route::get('',	       								['as' => 'configuracoes', 	        						'uses' => 'Configuracoes\ConfiguracoesController@index']);
		Route::post('save/number-default',	    			['as' => 'configuracoes.save.number-default', 	        	'uses' => 'Configuracoes\ConfiguracoesController@saveNumberDefault']);
		Route::post('save/new-grouping',	    			['as' => 'configuracoes.save.new-grouping', 	        	'uses' => 'Configuracoes\ConfiguracoesController@saveNewGrouping']);
		Route::post('edit/sector',	    					['as' => 'configuracoes.edit.sector', 	        			'uses' => 'Configuracoes\ConfiguracoesController@editSector']);
		Route::post('edit/training-group', 					['as' => 'configuracoes.edit.training-group',      			'uses' => 'Configuracoes\ConfiguracoesController@editTrainingGroup']);
		Route::post('edit/disclosure-group', 				['as' => 'configuracoes.edit.disclosure-group',      		'uses' => 'Configuracoes\ConfiguracoesController@editDisclosureGroup']);
		Route::get('link/{id}/users_training-group', 		['as' => 'configuracoes.link.users_training-group',     	'uses' => 'Configuracoes\ConfiguracoesController@linkUsersTrainingGroup']);
		Route::get('link/{id}/users_direction-management', 	['as' => 'configuracoes.link.users_direction-management',   'uses' => 'Configuracoes\ConfiguracoesController@linkUsersDirectionManagement']);
		Route::get('link/{id}/users_disclosure-group', 		['as' => 'configuracoes.link.users_disclosure-group',   	'uses' => 'Configuracoes\ConfiguracoesController@linkUsersDisclosureGroup']);
		Route::get('link/{id}/users_sectors', 				['as' => 'configuracoes.link.users_sectors',   				'uses' => 'Configuracoes\ConfiguracoesController@linkUsersSectors']);
		Route::post('link/save', 							['as' => 'configuracoes.link.save',    						'uses' => 'Configuracoes\ConfiguracoesController@linkSave']);
	});
	
	/*
	* DOWNLOAD
	*/
	Route::get('/download/{file}', function ($file='') {
		return response()->download(storage_path('app/uploads/'.$file)); 
	});

	Route::get('/download/formulario/{file}', function ($file='') {
		return response()->file(storage_path('app/uploads/formularios/'.$file)); 
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


Route::get('/teste', 'HomeController@teste');


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

// Auth::routes();
