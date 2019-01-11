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
	Route::get('ajax/usuarios/retornarUsuarios',  							['as' => 'retornarUsuarios', 	  									'uses' => 'AjaxController@getUsers']);
	Route::post('ajax/usuarios/trocarSetor',  								['as' => 'ajax.usuarios.trocarSetor', 	  							'uses' => 'AjaxController@trocarSetor']);
	Route::post('ajax/usuarios/removerDoGrupo',								['as' => 'ajax.usuarios.removerDoGrupo', 	  						'uses' => 'AjaxController@removerDoGrupo']);
	Route::post('ajax/usuarios/aprovadoresPorSetor',						['as' => 'ajax.usuarios.aprovadoresPorSetor', 	  					'uses' => 'AjaxController@getAprovadoresPorSetor']);
	Route::post('ajax/usuarios/permissaoElaborador',						['as' => 'ajax.usuarios.permissaoElaborador', 	  					'uses' => 'AjaxController@setPermissaoElaborador']);
	Route::post('ajax/usuarios/permissaoAprovarListaPresenca',				['as' => 'ajax.usuarios.permissaoAprovarListaPresenca',				'uses' => 'AjaxController@setPermissaoAprovarListaPresenca']);
	Route::get('ajax/setores/retornarSetores',  							['as' => 'retornarSetores', 	  									'uses' => 'AjaxController@getSectors']);
	Route::post('ajax/setores/retornaSetoresExcetoUm',  					['as' => 'ajax.setores.retornaSetoresExcetoUm',						'uses' => 'AjaxController@retornaSetoresExcetoUm']);
	Route::post('ajax/upload',                          					['as' => 'ajax.upload.image',	                					'uses' => 'AjaxController@uploadEditorImage']);
	Route::post('ajax/documentos/retornaFormularios',   					['as' => 'ajax.documentos.formularios',	                			'uses' => 'AjaxController@getDocumentosFormularios']);
	Route::post('ajax/documentos/salvaObservacao',	    					['as' => 'ajax.documentos.salvaObservacao',							'uses' => 'AjaxController@salvaObservacao']);
	Route::post('ajax/documentos/getObservacoes',	    					['as' => 'ajax.documentos.getObservacoes',							'uses' => 'AjaxController@getObservacoes']);
	Route::post('ajax/documentos/okJustifyCancelRequest',					['as' => 'ajax.documentos.okJustifyCancelRequest',					'uses' => 'AjaxController@okJustifyCancelRequest']);
	Route::post('ajax/documentos/saveAttachedDocument',   					['as' => 'ajax.documentos.saveAttachedDocument', 	    			'uses' => 'AjaxController@saveAttachedDocument']);
	Route::post('ajax/documentos/saveNewDocument',   						['as' => 'ajax.documentos.saveNewDocument', 	    				'uses' => 'AjaxController@saveNewDocument']);
	Route::post('ajax/documentos/refreshFormsLinked',   					['as' => 'ajax.documentos.refreshFormsLinked', 	    				'uses' => 'AjaxController@refreshFormsLinked']);
	Route::post('ajax/anexos/save',											['as' => 'ajax.anexos.save',										'uses' => 'AjaxController@saveAttachment']);
	Route::post('ajax/anexos/getAnexos',									['as' => 'ajax.anexos.getAnexos',									'uses' => 'AjaxController@getAnexos']);
	Route::post('ajax/anexos/removeAttachment',								['as' => 'ajax.anexos.removeAttachment',							'uses' => 'AjaxController@removeAttachment']);
	Route::post('ajax/formularios/okJustifyCancelFormReviewRequest',		['as' => 'ajax.formularios.okJustifyCancelFormReviewRequest',		'uses' => 'AjaxController@okJustifyCancelFormReviewRequest']);
	Route::post('ajax/formularios/getFilesFormRevisions',					['as' => 'ajax.formularios.getFilesFormRevisions',					'uses' => 'AjaxController@getFileListAllFormRevisions']);
	Route::post('ajax/notificacoes/cleanAll',								['as' => 'ajax.notificacoes.cleanAll',								'uses' => 'AjaxController@cleanAll']);


    /*
	* BPMN 2.0
	*/
	Route::group(['prefix' => 'bpmn'], function() {
		Route::get('',	       		['as' => 'bpmn', 	        		'uses' => 'BPMN\BPMNController@index']);
    });
	
	
    /*
	* DOCUMENTAÇÃO
	*/
	Route::group(['prefix' => 'documentacao'], function() {
		Route::get('',	       						['as' => 'documentacao', 	       						'uses' => 'Documentacao\DocumentacaoController@index']);
		Route::post('validate-data',       			['as' => 'documentacao.validate-data', 	    			'uses' => 'Documentacao\DocumentacaoController@validateData']);
		// Route::post('save-attached-document',   	['as' => 'documentacao.save-attached-document', 	    'uses' => 'Documentacao\DocumentacaoController@saveAttachedDocument']);
		// Route::post('save-new-document',        	['as' => 'documentacao.save-new-document', 	            'uses' => 'Documentacao\DocumentacaoController@saveNewDocument']);
		Route::post('view-document',   				['as' => 'documentacao.view-document', 	    			'uses' => 'Documentacao\DocumentacaoController@viewDocument']);
		Route::post('save-edited-document',   		['as' => 'documentacao.save-edited-document', 	    	'uses' => 'Documentacao\DocumentacaoController@saveEditDocument']);
		Route::post('filter-documents-index',  		['as' => 'documentacao.filter-documents-index',	    	'uses' => 'Documentacao\DocumentacaoController@filterDocumentsIndex']);
		Route::post('make-doc-from-name',        	['as' => 'documentacao.make-doc-from-name',             'uses' => 'Documentacao\DocumentacaoController@makeDocumentPdfFromName']);
		Route::post('approval-document',  			['as' => 'documentacao.approval-document',	    		'uses' => 'Documentacao\DocumentacaoController@approvalDocument']);
		Route::post('reject-document',  			['as' => 'documentacao.reject-document',	    		'uses' => 'Documentacao\DocumentacaoController@rejectDocument']);
		Route::post('resend-document',  			['as' => 'documentacao.resend-document',	    		'uses' => 'Documentacao\DocumentacaoController@resendDocument']);
		Route::post('salva-lista-presenca',			['as' => 'documentacao.salva-lista-presenca',    		'uses' => 'Documentacao\DocumentacaoController@salvaListaPresenca']);
		Route::post('resend-list',  				['as' => 'documentacao.resend-list',	    			'uses' => 'Documentacao\DocumentacaoController@resendList']);
		Route::post('save-link-form',	     		['as' => 'documentacao.save-link-form',          		'uses' => 'Documentacao\DocumentacaoController@salvaVinculoFormulario']);
		Route::post('start-review',	     		['as' => 'documentacao.start-review',          			'uses' => 'Documentacao\DocumentacaoController@startReview']);
		Route::post('cancel-review',				['as' => 'documentacao.cancel-review', 					'uses' => 'Documentacao\DocumentacaoController@cancelReview']);
		Route::post('save-attached-start-workflow',	['as' => 'documentacao.save-attached-start-workflow',	'uses' => 'Documentacao\DocumentacaoController@salvaAnexoElaboradorEIniciaWorkflow']);
		Route::post('make-obsolete-doc',	  		['as' => 'documentacao.make-obsolete-doc',				'uses' => 'Documentacao\DocumentacaoController@makeObsoleteDoc']);
		Route::post('make-active-doc',	  	  		['as' => 'documentacao.make-active-doc',				'uses' => 'Documentacao\DocumentacaoController@makeActiveDoc']);
		Route::post('view-obsolete-doc',	  		['as' => 'documentacao.view-obsolete-doc',				'uses' => 'Documentacao\DocumentacaoController@viewObsoleteDoc']);
		Route::get('{id}/edit-info',  				['as' => 'documentacao.edit-info',						'uses' => 'Documentacao\DocumentacaoController@editInfo']);
		Route::post('update-info', 					['as' => 'documentacao.update-info',					'uses' => 'Documentacao\DocumentacaoController@updateInfo']);
	});
	
	
	/*
	* FORMULÁRIOS
	*/
	Route::group(['prefix' => 'formularios'], function() {
		Route::get('',	       		          ['as' => 'formularios', 	        	          	'uses' => 'Formularios\FormulariosController@index']);
		Route::post('validate-data',          ['as' => 'formularios.validate-data',	          	'uses' => 'Formularios\FormulariosController@validateData']);
		Route::post('view-formulario',	      ['as' => 'formularios.view-formulario', 	      	'uses' => 'Formularios\FormulariosController@viewForm']);
		Route::post('filter-forms-index',     ['as' => 'formularios.filter-forms-index',      	'uses' => 'Formularios\FormulariosController@filterFormsIndex']);
		Route::post('save-attached-document', ['as' => 'formularios.save-attached-document',  	'uses' => 'Formularios\FormulariosController@saveAttachedDocument']);
		Route::post('approval-form',  		  ['as' => 'formularios.approval-form',	    	  	'uses' => 'Formularios\FormulariosController@approvalForm']);
		Route::post('reject-form',  		  ['as' => 'formularios.reject-form',	    	  	'uses' => 'Formularios\FormulariosController@rejectForm']);
		Route::post('resend-form',  		  ['as' => 'formularios.resend-form',	    	  	'uses' => 'Formularios\FormulariosController@resendForm']);
		Route::post('start-review',	      	  ['as' => 'formularios.start-review',     	  		'uses' => 'Formularios\FormulariosController@startReview']);
		Route::post('send-new-review',	      ['as' => 'formularios.send-new-review', 	  		'uses' => 'Formularios\FormulariosController@sendNewReview']);
		Route::post('cancel-review',		  ['as' => 'formularios.cancel-review', 			'uses' => 'Formularios\FormulariosController@cancelReview']);
		Route::post('make-obsolete-form',	  ['as' => 'formularios.make-obsolete-form',		'uses' => 'Formularios\FormulariosController@makeObsoleteForm']);
		Route::post('make-active-form',	  	  ['as' => 'formularios.make-active-form',			'uses' => 'Formularios\FormulariosController@makeActiveForm']);
		Route::post('view-obsolete-form',	  ['as' => 'formularios.view-obsolete-form',		'uses' => 'Formularios\FormulariosController@viewObsoleteForm']);
		Route::get('{id}/edit-info',  		  ['as' => 'formularios.edit-info',					'uses' => 'Formularios\FormulariosController@editInfo']);
		Route::post('update-info', 			  ['as' => 'formularios.update-info',				'uses' => 'Formularios\FormulariosController@updateInfo']);
	});




	Route::group(['middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware']], function() {

		/*
		* CONFIGURAÇÕES
		*/
		Route::group(['prefix' => 'configuracoes'], function() {
			Route::get('',	       								['as' => 'configuracoes', 	        						'uses' => 'Configuracoes\ConfiguracoesController@index']);
			Route::post('filter',	       						['as' => 'configuracoes.filter-sector',  					'uses' => 'Configuracoes\ConfiguracoesController@filter']);
			Route::post('save/number-default',	    			['as' => 'configuracoes.save.number-default', 	        	'uses' => 'Configuracoes\ConfiguracoesController@saveNumberDefault']);
			Route::post('save/number-default-dg',    			['as' => 'configuracoes.save.number-default-dg',        	'uses' => 'Configuracoes\ConfiguracoesController@saveNumberDefaultDG']);
			Route::post('save/number-default-pg',    			['as' => 'configuracoes.save.number-default-pg',        	'uses' => 'Configuracoes\ConfiguracoesController@saveNumberDefaultPG']);
			Route::post('save/new-grouping',	    			['as' => 'configuracoes.save.new-grouping', 	        	'uses' => 'Configuracoes\ConfiguracoesController@saveNewGrouping']);
			Route::post('save/quality-admin',	    			['as' => 'configuracoes.save.quality-admin', 	        	'uses' => 'Configuracoes\ConfiguracoesController@saveQualityAdmin']);
			Route::post('edit/sector',	    					['as' => 'configuracoes.edit.sector', 	        			'uses' => 'Configuracoes\ConfiguracoesController@editSector']);
			Route::post('edit/training-group', 					['as' => 'configuracoes.edit.training-group',      			'uses' => 'Configuracoes\ConfiguracoesController@editTrainingGroup']);
			Route::post('edit/disclosure-group', 				['as' => 'configuracoes.edit.disclosure-group',      		'uses' => 'Configuracoes\ConfiguracoesController@editDisclosureGroup']);
			Route::get('link/{id}/users_training-group', 		['as' => 'configuracoes.link.users_training-group',     	'uses' => 'Configuracoes\ConfiguracoesController@linkUsersTrainingGroup']);
			Route::get('link/{id}/approver_sector', 			['as' => 'configuracoes.link.approver_sector',   			'uses' => 'Configuracoes\ConfiguracoesController@linkApproverSector']);
			Route::get('link/{id}/users_disclosure-group', 		['as' => 'configuracoes.link.users_disclosure-group',   	'uses' => 'Configuracoes\ConfiguracoesController@linkUsersDisclosureGroup']);
			Route::get('link/{id}/users_sectors', 				['as' => 'configuracoes.link.users_sectors',   				'uses' => 'Configuracoes\ConfiguracoesController@linkUsersSectors']);
			Route::post('link/save', 							['as' => 'configuracoes.link.save',    						'uses' => 'Configuracoes\ConfiguracoesController@linkSave']);
			Route::get('lista-presenca/{id}/aprovadores',		['as' => 'configuracoes.lista_presenca.aprovadores',    	'uses' => 'Configuracoes\ConfiguracoesController@defineAprovadoresListaPresenca']);
		});

	});




	/*
	* SOBRE
	*/
	Route::group(['prefix' => 'sobre'], function() {
		Route::get('',	   ['as' => 'sobre',	'uses' => 'SobreController@index']);
	});
	

	/*
	* DOWNLOAD
	*/
	Route::get('/download/{file}', function ($file='') {
		return response()->download(storage_path('app/uploads/'.$file)); 
	});

	Route::get('/download/lista-presenca/{file}', function ($file='') {
		return response()->download(storage_path('app/lists/'.$file)); 
	});

	Route::get('/download/formulario/{file}', function ($file='') {
		return response()->file(storage_path('app/uploads/formularios/'.$file)); 
	});

	//DocumentViewer Library
	Route::any('ViewerJS/{all?}', function(){
		return View::make('ViewerJS.index');
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

/*
* Usuário não tem permissão para acessar essa página
*/
Route::get('unauthorized', 	['as' => 'unauthorized', 'uses' => 'UnauthorizedController@index']);


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
