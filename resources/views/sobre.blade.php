@extends('layouts.app')

@section('content')
 <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="col-md-7 col-4 align-self-center">
                <div class="">
                    <a href="{{ URL::route('documentacao') }}" class="waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10" data-toggle="tooltip" title="Retornar aos Documentos" style="position: fixed; bottom: 20px; right: 20px; padding: 25px;">
                        <i class="ti-home text-white" style="position: absolute; top: 22px; left: 22px;"></i>
                    </a>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="fix-width">
                <div class="row p-t-30">
                    <div class="col-12">
                        

                        

                        



                        <div class="card" id="intro">
                                <div class="card-body">
                                    <h3>1. Introdução</h3>
                                    <p>
                                        <br/>A ferramenta foi construída com o intuito de automatizar o controle de elaboração dos documentos e formulários pelo setor de processos, onde todas as partes envolvidas na elaboração interajam com a ferramenta, assim centralizando todas as informações em um único lugar.</p>
                                   
                                </div>
                            </div>
                           
                            <div class="card" id="geral">
                                <div class="card-body">
                                    <h3>2 Acesso ao sistema</h3>
                                    <p>
                                        <br/> O sistema é compatível com os navegadores Chrome (preferencialmente) e Firefox. Para acessar segue link completo de acesso: <code>http://dpws1sva013/qualidade/login</code></p>
                                    <p>
									                     	<br/> Para realizar o login, deve-se informar login de usuário e senha. Clique em <code>ENTRAR.</code> </p>
										                    <div class="alert alert-warning">NOTE: O usuário e senha para realizar login na aplicação foram integrados com o AD.</div>
                                    <p>
                                    	<br/> Selecionando a opção <code> Mantenha-me conectado </code> o sistema não fechará a conexão automaticamente ao atingir o tempo padrão. </p>
                                    <p>
                                       <!--  <img src="assets/images/Imagens/login.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/login.jpg') }}" class="img-fluid" alt="Login na Aplicação">
                                    </p>
                                </div>
                            </div>
                            <!-- card -->
                            <div class="card" id="geral">
                                <div class="card-body">
                             		<h3>3. Navegação no sistema</h3>
                                    <p>
                                        <br/> O  sistema permite aos usuários a expansão do menu, que detalha as opções do menu, e a retração, ampliando a área de trabalho dos usuários. </p>
                                    <p>
                                        <!-- <img src="assets/images/Imagens/navegacao.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/navegacao.jpg') }}" class="img-fluid" alt="Navegação na Aplicação">
                                    </p>
                                </div>
                            </div>
                            
                            <div class="card" id="geral">
                                <div class="card-body">
                             		<h3>4. Sair do Sistema</h3>
                                    <p>
                                        <br/> Para fazer logout no sistema, expandir o menu lateral, e pressionar o botão <code>Sair.</code> </p>
                                    <p>
                                       <!-- <img src="assets/images/Imagens/logof.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/logof.jpg') }}" class="img-fluid" alt="Logout da Aplicação">
                                    </p>
                                </div>
                            </div>
                            <!-- card -->
                            <!-- card -->

                            <div class="card" id="setores">
                                <div class="card-body">
                                    <h3>5. Setores da Empresa</h3>
                                    <p>
                                    	<br/> O cadastro de setores da empresa está disponível no menu <code>Configurações</code> -> <code>Agrupamentos</code> -> <code>Setores da Empresa.</code> </p>
                                   <p>
                                   		<br/> As ações permitidas para cada setor são Vincular usuários, selecionando as setinhas, e Editar, selecionando o lápis. </p>
                                   <p>
                                        <!-- <img src="assets/images/Imagens/setores.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/setores.jpg') }}" class="img-fluid" alt="Setores">
                                   <p>
                                   		<br/> Para confirmar a operação é necessário selecionar a opção <code> Atualizar Vinculação </code>. </p>
                                   <p>
                                   		<!-- <img src="assets/images/Imagens/vinculacao.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/vinculacao.jpg') }}" class="img-fluid" alt="Vinculação de Usuários">
                                   <p>
                                   		<br/> Para desvincular um usuário, basta clicar sobre ele no quadro direito. O sistema irá abrir uma tela para realizar a desvinculação, para isso o usuário deve clicar em <code> Alterar </code>. </p>
                                   <p>
                                   		<!-- <img src="assets/images/Imagens/desvinculacao.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/desvinculacao.jpg') }}" class="img-fluid" alt="Desvinculação de Usuários">
                                   <p>
                                </div>
                            </div>

                            <div class="card" id="setores">
                                <div class="card-body">
                                    <h3>6. Edição de Setores</h3>
                                    <p>Ao editar um setor o sistema permite alterar o nome, a sigla e a descrição. Após fazer as alterações basta pressionar a opção <code> Salvar.</code> </p>
                                   <p>
                                        <!-- <img src="assets/images/Imagens/edicao.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/edicao.jpg') }}" class="img-fluid" alt="Edição de Setores">
                                    </p>
                                </div>
                            </div>

                            <div class="card" id="grupos">
                                <div class="card-body">
                                    <h3>7. Criação de Setores</h3>
                                    <p> 
                                    	<br/> O cadastro de novos setores está disponível no menu <code> Configurações </code> -> <code> Novo Agrupamento.</code> </p>
                                   <p>
                                        <!-- <img src="assets/images/Imagens/agrupamento.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/agrupamento.jpg') }}" class="img-fluid" alt="Criação de Setores">
                                   <p>
										                  <br/> Campos a serem preenchidos na geração do documento: </p>
                                   <p>
                                   		<li> Nome do Agrupamento: definir o nome do novo setor.</li>
                                   		<li> Tipo de Agrupamento: será sempre tipo setor. </li>
                                   		<li> Descrição do Agrupamento: definir uma breve descrição sobre o grupo que está sendo criado. </li> 
                                      <li> Após clique em <code> Atualizar Vinculações. </code> </li>
                                   </p>
                                </div>
                            </div> 

                            <div class="card" id="aprovadores">
                                <div class="card-body">
                                    <h3>8. Aprovadores</h3>
                                    <p> 
                                    	<br/> A vinculação dos usuários que serão aprovadores de cada setor da empresa está disponível em <code> Configuraçãoes </code> -> <code> Agrupamentos </code> -> <code> Aprovadores. </code> </p>
                                    <p>
                                        <!-- <img src="assets/images/Imagens/aprovadores.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/aprovadores.jpg') }}" class="img-fluid" alt="Aprovadores">
                                    <p>
                                   		
                                    <div class="card" id="aprovadores">
                                        <div class="card-body">
                                             <h3>8.1. Vinculação de Aprovadores</h3>
                                             <p> 
                                    	        <br/> Para realizar a vinculação dos usuários a Aprovadores deve-se acessar <code>Configuração </code> -> <code> Agrupamentos </code> -> <code> Aprovadores. </code> </p>
                                             <p>
                                                <!-- <img src="assets/images/Imagens/vinculacao_aprovador.jpg" alt="template" class="img-responsive" /> -->
                                                <img src="{{ asset('images/Imagens/vinculacao_aprovador.jpg') }}" class="img-fluid" alt="Vinculação Aprovadores">
                                             <p>
                                   		        <br/> Após clique em <code> Atualizar Vinculações. </code> </p>
                                             <p>
                                        </div>
                                    </div>
                                </div>
                        	</div>

                            <div class="card" id="padroes">
                                <div class="card-body">
                                    <h3>9. Padrão de Códigos</h3>
                                   <p> 
                                    	<br/> A configuração do padrão de códigos está disponível no menu <code>Configuração </code> -> <code> Padrões </code>. </p>
                                   <p>
                                        <br/> Na tela é possível definir um padrão de código para cada Tipo de Documento </p>
                                   <p>
                                        <br/> No campo "Padrão para Código:" deve ser informado a máscara que a aplicação deverá seguir para a geração dos códigos de cada Tipo de Documento </p>

                                    <p>    
                                   		 <br/> Após clique no botão <code> Salvar </code> </p>
                                   <p>
 									                  	<div class="alert alert-warning">NOTE: Lembrando que essa configuração é para a sequência dos códigos após a nomenclatura inicial. Seguir sempre os exemplos apresentados na tela.</div>
 									                 <p>
                                       <!-- <img src="assets/images/Imagens/codigos.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/codigos.jpg') }}" class="img-fluid" alt="Padrão de Códigos">
                                   <p>
                                   		
                               </div>
                            </div>

                             <div class="card" id="padroes">
                                <div class="card-body">
                                    <h3>10. Administrador Setor Processos</h3>
                                   <p> 
                                    	<br/> A configuração do usuário do setor de processos que terá acesso a aprovação dos documentos confidenciais está disponível no menu <code>Configuração </code> -> <code> Padrões </code>. </p>
                                   <p>
                                        <br/> No campo "Administrador - Setor Processos:" deve ser selecionado o usuário. Após clique no botão <code> Salvar </code>. </p>
                                   <p>
 									                      <!-- <img src="assets/images/Imagens/confidencial.jpg" alt="template" class="img-responsive" /> -->
 									                      <img src="{{ asset('images/Imagens/confidencial.jpg') }}" class="img-fluid" alt="Configuração Administrador Setor Processos">
                                   <p>
                                   		
                               </div>
                            </div>

                            <div class="card" id="elaboracao">
                                <div class="card-body">
                                    <h3>11. Elaboração </h3>
                                   <p> 
                                    	<br/> A elaboração de documentos está disponível no menu <code>Documentação </code> -> <code> Gerar Documentos </code>. </p>
                                   <p>
 									                    <!--<img src="assets/images/Imagens/elaboracao.jpg" alt="template" class="img-responsive" /> -->
 									                    <img src="{{ asset('images/Imagens/elaboracao.jpg') }}" class="img-fluid" alt="Elaboração de Documentos">
                                   <p>
                                        <br/> <li>Setor: definição do setor que está sendo elaborado o documento </a></li>
                                        <br/> <li>Tipo de Documento: definição do tipo de documento que está sendo elaborado ( Instrução de Trabalho, Procedimento de Gestão ou Diretriz de Gestão). </a></li>
                                        <br/> <li>Acesso: definição do acesso aos documentos (Livre, Restrito e Confidencial). </a></li> </p>
                                        <div class="alert alert-info">Livre: Todos os envolvidos na elaboração do documento e qualquer outro usuário não participou se sua elaboração terão acesso a visualizar o documento após sua finalização.</p>
                                        Restrito: Todos os envolvidos na elaboração do documento e o setor que pertence o documento terão acesso a visualizar o documento após sua finalização. </p>
                                        Confidencial: Todos os envolvidos na elaboração do documento terão acesso a visualizar o documento após sua finalização.
                                        </div>                 
                                        <br/> <li>Aprovador: responsável por realizar a aprovação do documento. </a></li>
                                        <br/> <li>Área de Interesse: definição do setor / usuário que fazem parte da elaboração do documento. </a></li>
                                        <br/> <li>Grupo de Treinamento: definição dos usuários ou setor que receberam o treinamento referente o novo documento. </a></li>
                                        <br/> <li>Grupo de Divulgação:  definição dos usuários ou setor que após a finalização do documentos serem notificados. </a></li>
                                        <br/> <li>Validade do Documento: definição da validade do documento. </a></li>
                                        <br/> <li>Cópia Controlada: opção para definir se após a finalização do documento, o setor de Processos será notificado para realizar a impressão das cópias controladas. </a></li>
                                        <br/> <li>Título do Documento: descrição do nome do documento. </a></li>
                                        <br/> <li>Atrelar aos Formulários: opção para selecionar os formulários que estarão vinculados ao documentos que está sendo elaborado. </a></li>
                                   </p>
                                   		<div class="alert alert-warning">NOTA: <li>Código do Documento: será gerado automaticamente pela aplicação. </a></li>.</div>
 								                    <p>
 										                  <br/> Após preencher todos os campos o Elaborador poderá: </p>
                                   <p>
                                   		<br/> <li>Criar um documento através do Editor da aplicação. </a></li>
                                   		<br/> <li>Importar um documento já existente. </a></li>  
                                   <p>
                                   		<br/> O Elaborador insere as informações no documento, e após deve clicar em <code> Salvar Documento</code>, nesse momento é aberta a tela para realizar a inclusão de anexos.	
 								                   <p>
										                  <!--<img src="assets/images/Imagens/anexos.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/anexos.jpg') }}" class="img-fluid" alt="Envio do Documento ao setor Processos"> 
                                   <p>
                                   		<br/> Após realizar a inclusão dos anexos ao documento, deve clicar em <code> Concluir e Enviar ao setor Processos</code>, nesse momento o documento é encaminhado para o próximo setor para análise do documento. 
                                   <p>
                                   		<div class="alert alert-warning">NOTA: <li>A inclusão de anexos aos documentos não é obrigatória.</a></li>.</div>

                                   		<!--<img src="assets/images/Imagens/envio_documento.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/envio_documento.jpg') }}" class="img-fluid" alt="Envio do Documento ao setor Processos">                                         
                               </div>
                            </div>

                             <div class="card" id="criar">
                                <div class="card-body">
                                    <h3>12. Criar</h3>
                                   <p> 
                                    	<br/> Após informar todos os campos para gerar um documento, o Elaborador ao clicar em <code> Criar Documento</code> será redirecionado para a tela de criação de documento. A aplicação trará o padrão de layout conforme definido o tipo de documento no momento da geração do documento: </p>
                                   <p>
 									                    <br/> <li>Instrução de Trabalho. </a></li>
                                   		<br/> <li>Procedimento de Gestão. </a></li>
                                   		<br/> <li>Diretriz de Gestão. </a></li>
                                   	<p>
 									                    <!-- <img src="assets/images/Imagens/criar_doc.jpg" alt="template" class="img-responsive" /> -->
 									                    <img src="{{ asset('images/Imagens/criar_doc.jpg') }}" class="img-fluid" alt="Criação de Documento">
                                   <p>
                                   		<div class="alert alert-warning">NOTE: Funções do Editor de Documento, estão disponível no menu Editor de Documento</a></li>.</div>
                                </div>
                            </div>

                             <div class="card" id="importar">
                                <div class="card-body">
                                    <h3>13. Importar</h3>
                                   <p> 
                                    	<br/> Após informar todos os campos para gerar um documento, o Elaborador ao clicar em <code>Importar Documento </code>será redirecionado para a tela de importação de documento.  </p>
                                   <p>
 									                    <!--<img src="assets/images/Imagens/importar_doc.jpg" alt="template" class="img-responsive" /> -->
 									                    <img src="{{ asset('images/Imagens/importar_doc.jpg') }}" class="img-fluid" alt="Importação de Documento">
                                   <p>
                                   		<br/> O usuário será redirecionado a tela para upload do arquivo. Conforme imagem abaixo. </p>
                                   <p>
                                   		<!--<img src="assets/images/Imagens/upload.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/upload.jpg') }}" class="img-fluid" alt="Upload do Documento">
                                   <p>
                                   		<br/> Após selecionar o documento, clique em <code> Salvar Documento </code>. </p>
                                </div>
                            </div>

                                 <div class="card" id="editor">
                                    <div class="card-body">
                                        <h3>14. Editor </h3>
                                               <p> 
                                                	<br/> Para realizar a edição de um documento, deve-se selecionar o texto que será realizado a alteração e após clicar sobre a opção que será utilizada. Como por exemplo: Alteração de cor, alteração de fonte, tamanho da letra, etc. </p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/editor.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/editor.jpg') }}" class="img-fluid" alt="Formatação do Texto">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="processos">
                                            <div class="card-body">
                                                <h3>15. Processos</h3>
                                               <p> 
                                                	<br/> Após o documento ser elaborado o mesmo é encaminhado ao setor Processos para iniciar o Workflow de aprovação do documento. O setor Processos será notificado que possui um novo documento para ser analisado. Conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/qualidade_not.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/qualidade_not.jpg') }}" class="img-fluid" alt="Notificação Processos">
                                               <p>
                                               		<br/> É possível através da notificação acessar o documento para realizar a análise. </p>
                                               <p>

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.1 Rejeitar um Documento</h3>
                                                       <p> 
                                                        	<br/> Para realizar a rejeição de um documento, o usuário deve clicar em Rejeitar, nesse momento o documento é retornado ao Elaborador para ajustes.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/rejeitar.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/rejeitar.jpg') }}" class="img-fluid" alt="Rejeitar Documento">
                                                       <p>
                                                       		<br/> Abrirá a tela para informar a Justificativa da rejeição </p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/justificativa.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/justificativa.jpg') }}" class="img-fluid" alt="Justificativa da Rejeição">
                                                       <p>
                                                       		<br/> Após o documento ser rejeitado será disparado uma notificação ao Elaborador que o documento necessita de correções. </p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/elaborador_not.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/elaborador_not.jpg') }}" class="img-fluid" alt="Notificação Elaborador">
                                                       <p>
                                                       		<br/>Nesse momento o elaborador visualiza as informações sugeridas pelo setor Processos, realiza as correções e segue com o Workflow, enviando novamente ao setor Processos para análise.</p>
                                                       <p>
                                                    </div>
                                                </div>

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.2 Aprovar Documento</h3>
                                                       <p> 
                                                        	<br/> Para realizar a aprovação de um documento, o usuário deve clicar em Aprovar, nesse momento o documento é encaminhado para o próximo passo do Workflow para análise do documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/aprovado.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/aprovado.jpg') }}" class="img-fluid" alt="Documento Aprovado">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.3 Tornar Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para tornar um documento obsoleto,  o usuário deve clicar em Tornar Obsoleto, nesse momento o sistema mostrará em tela uma mensagem de confirmação para tornar o documento obsoleto ou não.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/tornar_obsoleto.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/tornar_obsoleto.jpg') }}" class="img-fluid" alt="Documento Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.4 Desfazer Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para desfazer o documento que está obsoleto,  o usuário deve clicar em Ativar Documento, nesse momento o sistema mostrará em tela uma mensagem de confirmação para ativar o documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/desfazer_obsoleto.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/desfazer_obsoleto.jpg') }}" class="img-fluid" alt="Documento Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                 <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.5 Víncular Formulários</h3>
                                                       <p> 
                                                        	<br/> Para realizar a vinculação de formulários a documentos, o usuário deve clicar em Víncular Formulários, nesse momento o sistema mostrará em tela uma mensagem de confirmação para ativar o documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/vincular_form.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/vincular_form.jpg') }}" class="img-fluid" alt="Víncular Formulário">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.6 Editar Informações</h3>
                                                       <p> 
                                                          <br/> Para realizar a edição das informações do registro do documento. O usuário deve clicar em Editar Informações.</p>
                                                       <p>
                                                          <!--<img src="assets/images/Imagens/editar_info.jpg" alt="template" class="img-responsive" /> -->
                                                          <img src="{{ asset('images/Imagens/editar_info.jpg') }}" class="img-fluid" alt="Editar Informações">
                                                       <p>
                                                          <br/> O usuário será redirecionado a tela de edição.</p>
                                                       <p>
                                                          <!--<img src="assets/images/Imagens/editar.jpg" alt="template" class="img-responsive" /> -->
                                                          <img src="{{ asset('images/Imagens/editar.jpg') }}" class="img-fluid" alt="Editar Informações">
                                                       <p>
                                                          <br/> Após clique em <code> Atualizar Informações </code>.</p>
                                                       <p>
                                                    </div>
                                                </div>

                                                <div class="card" id="processos">
                                                    <div class="card-body">
                                                        <h3>15.7 Cópia Controlada</h3>
                                                       <p> 
                                                          <br/> Para realizar o controle das cópias controladas. O usuário deve clicar em Editar Informações.</p>
                                                       <p>
                                                          <!--<img src="assets/images/Imagens/editar_info.jpg" alt="template" class="img-responsive" /> -->
                                                          <img src="{{ asset('images/Imagens/editar_info.jpg') }}" class="img-fluid" alt="Editar Informações">
                                                       <p>
                                                          <br/> O usuário será redirecionado a tela de edição.</p>
                                                       <p>
                                                          <!--<img src="assets/images/Imagens/editar_copia.jpg" alt="template" class="img-responsive" /> -->
                                                          <img src="{{ asset('images/Imagens/editar_copia.jpg') }}" class="img-fluid" alt="Editar Cópia Controlada">
                                                       <p>
                                                          <br/> Se o documento tiver a opção de Cópia Controlada marcado como <code> Sim </code>, estará habilitado o botão <code> Gerenciar </code>.</p>
                                                          <br/> Ao clicar em <code> Gerenciar </code> abrirá a tela de gerenciamento  das cópias controladas.</p>
                                                       <p>
                                                          <!--<img src="assets/images/Imagens/gerenciar_copia.jpg" alt="template" class="img-responsive" /> -->
                                                          <img src="{{ asset('images/Imagens/gerenciar_copia.jpg') }}" class="img-fluid" alt="Gerenciar Cópia Controlada">
                                                       <p>
                                                          <br/> Nessa tela o usuário deve preencher os campos <code> Revisão </code> e <code> Setor </code>, e após clicar em <code> Salvar Registro </code>.</p>
                                                       <p>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div> 

                                        <div class="card" id="areainteresse">
                                            <div class="card-body">
                                                <h3>16. Área de Interesse</h3>
                                                <p> 
                                                   	<br/> Após o documento ser aprovado pelo setor Processos, a Área de Interesse será notificada que possui um novo documento para analisar.</p>
                                                <p>
                                                	<br/> O processo de aprovação e rejeição do documento é o mesmo demonstrado no menu <code> Processos</code>
                                                <p>

                                            </div> 
                                        </div>

                                        <div class="card" id="aprovador">
                                            <div class="card-body">
                                                <h3>17. Aprovador</h3>
                                               <p> 
                                                	<br/> Após o documento ser aprovado pela Área de Interesse, o Aprovador será notificado que possui um novo documento para analisar.</p>
                                               <p>
                                               		<br/> O processo de aprovação e rejeição do documento é o mesmo demonstrado no menu <code> Processos</code>
                                               <p>
                                            </div>
                                        </div> 

                                        <div class="card" id="listadepresenca">
                                            <div class="card-body">
                                                <h3>18. Lista de Presença</h3>
                                               <p> 
                                                	<br/> Após o documento ser aprovado pelo Aprovador, o documento é encaminhado ao Elaborador para anexar a lista de presença. Conforme imagem abaixo</p>
                                               <p>
                                               		
                                               		<!--<img src="assets/images/Imagens/upload_lista.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/upload_lista.jpg') }}" class="img-fluid" alt="Upload Lista de Presença">
                                               <p>
                                            </div>
                                        </div> 

                                        <div class="card" id="pessoas">
                                            <div class="card-body">
                                                <h3>19. Pessoas & Organizações</h3>
                                               <p> 
                                                	<br/> Após o Elaborador realizar o upload da lista de presença, o setor de Pessoas será notificado por e-mail que possui uma nova lista de presença que requer análise. A lista de presença será enviada em anexo no e-mail.</p>
                                               <p>
                                               		<br/> É possível através da notificação acessar o documento para realizar a análise. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/notificacao_lista.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/notificacao_lista.jpg') }}" class="img-fluid" alt="Aprovação da Lista de Presença">
                                               <p>        
                                            </div>
                                        </div>

                                         <div class="card" id="divulgacao">
                                            <div class="card-body">
                                                <h3>20. Divulgação </h3>
                                               <p> 
                                                	<br/> A divulgação do documento ocorre após a lista de presença ser enviada para o setor de Pessoas. É disparado uma notificação por e-mail, aos envolvidos na elaboração do documento.</p>
                                               <p>
                                               		
                                               		<!--<img src="assets/images/Imagens/notificacao_divulgacao.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/notificacao_divulgacao.jpg') }}" class="img-fluid" alt="Divulgação do Documento">
                                               <p>
                                            </div>
                                        </div> 

                                        <div class="card" id="visualizacao">
                                            <div class="card-body">
                                                <h3>21. Visualização </h3>
                                               <p> 
                                                	<br/> Para visualizar os documentos existentes na aplicação, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code>.</p>
                                               <p>
                                               		
                                               		<!--<img src="assets/images/Imagens/visualizacao.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/visualizacao.jpg') }}" class="img-fluid" alt="Visualização do Documento">
                                               <p>
                                               		<br/> Campos disponíveis para filtragem.</p>

                                                  <li>Tipo de Documento;</li>
                                                  <li>Status;</li>
                                                  <li>Nível de Acesso;</li>
                                               		<li>Setor;</li>
                                               		<li>Validade;</li>
                                               		<li>Possui Cópia Controlada;</li>
                                               		<li>Título do Documento;</li>
                                                  <li>Obsoletos.</li>
                                               <p>
                                                  <br/> É possível também realizar a pesquisa de outros campos, utilizando o campo "Pesquisar" no canto superior direito da tela.</p>
                                               <p>

                                               <div class="card" id="visualizacao">
                                                    <div class="card-body">
                                                         <h3>21.1 Documentos Obsoletos </h3>
                                                        <p> 
                                                    	   <br/> Para visualizar os documentos obsoletos, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code> -> </code> Botão Obsoletos </code>.</p>
                                                        <p>
                                                   		
                                                   		   <!--<img src="assets/images/Imagens/obsoletos.jpg" alt="template" class="img-responsive" /> -->
                                                   		   <img src="{{ asset('images/Imagens/obsoletos.jpg') }}" class="img-fluid" alt="Status do Documento">
                                                        <p>
                                                   		   <br/> O usuário será redirecionado a tela onde será listado somente os documentos obsoletos.</p>
                                                        <p>
                                                   		   <!--<img src="assets/images/Imagens/docs_obsoletos.jpg" alt="template" class="img-responsive" /> -->
                                                   		   <img src="{{ asset('images/Imagens/docs_obsoletos.jpg') }}" class="img-fluid" alt="Timeline do Documento">
                                                    </div>
                                                </div> 

                                                <div class="card" id="visualizacao">
                                                    <div class="card-body">
                                                         <h3>21.2 Linha do Tempo </h3>
                                                        <p> 
                                                         <br/> Para visualizar a linha do tempo dos documentos, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code> -> </code> Acessar um documento </code> -> </code> Clicar em Ver Linha do Tempo </code>.</p>
                                                        <p>
                                                      
                                                         <!--<img src="assets/images/Imagens/linha_tempo.jpg" alt="template" class="img-responsive" /> -->
                                                         <img src="{{ asset('images/Imagens/linha_tempo.jpg') }}" class="img-fluid" alt="Linha do Tempo">
                                                        <p>
                                                         <br/> O usuário poderá visualizar todo o histórico do documento desde a sua criação.</p>
                                                        <p>
                                                    </div>
                                                </div>

                                                <div class="card" id="visualizacaoform">
                                                    <div class="card-body"> 
                                                        <h3>21.3 Relatório </h3>
                                                        <p> 
                                                            <br/> É possível o usuário realizar a geração de relatório, esse relatório listará as informações presentes na tela como por exemplo: Código do Documento, Título, Status, etc. Para essa geração o usuário deve acessar <code>Documentação </code> -> <code> Visualizar Documentos </code> estará disponível as opção <code> Excel, PDF e Imprimir </code>.</p>
                                                        <p>
                                                            <!--<img src="assets/images/Imagens/relatorio_doc.jpg" alt="template" class="img-responsive" /> -->
                                                            <img src="{{ asset('images/Imagens/relatorio_doc.jpg') }}" class="img-fluid" alt="Relatório Documento">
                                                    </div>
                                                </div>  
                                            </div>
                                        </div> 

                                        <div class="card" id="revisao">
                                            <div class="card-body">
                                                <h3>22. Revisão </h3>
                                                <p> 
                                            	    <br/> Para realizar a revisão de um documento, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code> -> <code> Ações </code> -> <code> Solicitar Revisão </code>.</p>
                                                <p>
                                                   		
                                                    <!--<img src="assets/images/Imagens/revisao.jpg" alt="template" class="img-responsive" /> -->
                                                    <img src="{{ asset('images/Imagens/revisao.jpg') }}" class="img-fluid" alt="Revisão Documento">
                                                <p>
                                                    <br/> Qualquer usuário que tem acesso ao documento pode realizar a solicitação de revisão. Ao solicitar a revisão o usuário se torna o elaborador do documento. E nesse momento se inicia o fluxo do Workflow. Além de habilitar o campo para editar as informações do registro do documento como, por exemplo, Aprovador, Área de Interesse, etc.</p>
                                           
										                        <div class="card" id="revisao">
                                                 <div class="card-body">
                                                      <h3>22.1 Cancelar Revisão </h3>
                                                      <p> 
                                            	         <br/> Para realizar o cancelamento de uma, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code> e acessar o documento, onde mostrará a opção para realizar o cancelamento da revisão.</p>
                                                      <p>
                                                   		
                                                        <!--<img src="assets/images/Imagens/cancelar_revisao.jpg" alt="template" class="img-responsive" /> -->
                                                        <img src="{{ asset('images/Imagens/cancelar_revisao.jpg') }}" class="img-fluid" alt="Cancelar Revisão">
                                                      <p>
                                                        <br/> Ao clicar em <code> Cancelar Revisão </code>, o usuário deverá informar uma justificativa para o cancelamento. </p>

												                          	    <!--<img src="assets/images/Imagens/justificativa_revisao.jpg" alt="template" class="img-responsive" /> -->
                                                        <img src="{{ asset('images/Imagens/justificativa_revisao.jpg') }}" class="img-fluid" alt="Justificativa Revisão">

                                                      </p>
                                                	      <div class="alert alert-warning">NOTA: <li>Somente os usuários do setor Processos tem permissão para cancelar a revisão de um documento. </a></li>.</div>
                                                        </p>
                                                 </div>
                                        	    </div>
    									                        </div>
                                        </div>

                                        <div class="card" id="formularios">
                                            <div class="card-body">
                                                <h3>23. Elaboração </h3>
                                                <p> 
                                                    <br/> A elaboração de formulário está disponível no menu <code> Formulário </code> -> <code> Novo Formulário </code>.</p>
                                                <p>
                                                   		
                                                   	<!--<img src="assets/images/Imagens/formularios.jpg" alt="template" class="img-responsive" /> -->
                                                   	<img src="{{ asset('images/Imagens/formularios.jpg') }}" class="img-fluid" alt="Elabração de Formulários">
                                                <p>
                                                   	<br/> Campos a serem preenchidos na elaboração do formulário:</p>
                                                   	<li> Setor: definição do setor que está sendo elaborado o documento.</li>
                                                   	<li> Grupo de Divulgação: definição dos usuários ou setor que após a finalização do documentos serem notificados.</li>
                                                   	<li> Acesso: definição do acesso aos documentos (Livre e Restrito).</li>
                                                   	<li> Título do Formulário: descrição do nome do formulário.</li>
                                                <p>
                                                   	<br/> Após preencher todos os campos o Elaborador realizará a Importação do Formulário. </p>
                                            </div>
                                        </div> 

                                        <div class="card" id="importarform">
                                            <div class="card-body">	
                                                <h3>24.Importar </h3>
                                               <p> 
                                                	<br/> Ao informar todos os campos para criação do formulário, o Elaborador  deve clicar em <code> Importar Formulário </code>.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/importar_form.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/importar_form.jpg') }}" class="img-fluid" alt="Importar Formulário">
                                               <p>
                                               		<br/> O usuário será redirecionado a tela para upload do arquivo. Conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/upload_form"template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/upload_form.jpg') }}" class="img-fluid" alt="Upload Formulário">
                                               <p>
                                               		<br/>O Elaborador deve selecionar o arquivo e clicar em <code> Salvar Formulário </code>, onde será encaminhado ao setor de Processos para análise. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/elaboracao_form"template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/elaboracao_form.jpg') }}" class="img-fluid" alt="Elaboração Formulário">
                                            </div>
                                        </div> 

                                        <div class="card" id="processosform">
                                            <div class="card-body">	
                                                <h3>25.Processos </h3>
                                               <p> 
                                                	<br/> O setor Processos será notificado que recebeu um novo formulário para análise. Conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/qualidade_form.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/qualidade_form.jpg') }}" class="img-fluid" alt="Notificação Processos">
                                               <p>
                                               		<br/>É possível através da notificação acessar o formulário para realizar a análise.</p>
                                              
                                                <p>
                                               		<!--<img src="assets/images/Imagens/formulario_qua.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/formulario_qua.jpg') }}" class="img-fluid" alt="Formulários">
                                        	
                                               	<p>
                                        			    <br/> O setor de Processos poderá Rejeitar ou Aprovar a lista de presença.</p>
                                               		<div class="alert alert-info">Rejeitar: será habilitado uma caixa para informar a justificativa da rejeição e o formulário retorna ao Elaborador para ajustes.</p>
                                                  Aprovar: será realizado a divulgação do formulário. </p>
                                                  </div>  

                                             <div class="card" id="processosform">
                                                    <div class="card-body">
                                                        <h3>25.1 Tornar Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para tornar um formulário obsoleto,  o usuário deve clicar em Tornar Obsoleto, nesse momento o sistema mostrará em tela uma mensagem de confirmação para tornar o formulário obsoleto ou não.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/tornar_obsoleto_form.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/tornar_obsoleto_form.jpg') }}" class="img-fluid" alt="Formulário Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="processosform">
                                                    <div class="card-body">
                                                        <h3>25.2 Desfazer Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para desfazer o formulário que está obsoleto,  o usuário deve clicar em Ativar Formulário, nesse momento o sistema mostrará em tela uma mensagem de confirmação para ativar o formulário.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/desfazer_obsoleto_form.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/desfazer_obsoleto_form.jpg') }}" class="img-fluid" alt="Formulário Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>

                                        <div class="card" id="visualizacaoform">
                                            <div class="card-body">	
                                                <h3>26. Visualização </h3>
                                                <p> 
                                                    <br/> Para visualizar os formulários existentes na aplicação, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code>.</p>
                                                <p>
                                                   	<!--<img src="assets/images/Imagens/visualizar_form.jpg" alt="template" class="img-responsive" /> -->
                                                   	<img src="{{ asset('images/Imagens/visualizar_form.jpg') }}" class="img-fluid" alt="Visualização de Formulário"> 
                                                <p>
                                                    <br/> Campos disponíveis para filtragem.</p>

                                                    <li>Setor;</li>
                                                    <li>Nível Acesso;</li>
                                                    <li>Status;</li>
                                                    <li>Título do Formulário.</li>
                                                <p>

                                                    <br/> É possível também realizar a pesquisa de outros campos, utilizando o campo "Pesquisar" no canto superior direito da tela.</p>
                                                <p>

                                                <div class="card" id="visualizacaoform">
                                                    <div class="card-body">	
                                                        <h3>26.1 Status </h3>
                                                        <p> 
                                                            <br/> Para visualizar o status dos formulários, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code> coluna <code> Status </code>.</p>                                                           	
                                                        <p>
                                                           	<br/> Além da visualização na tela inicial, e possível ao acessar o formulário visualizar a linha do tempo, todo o seu histórico desde sua criação. </p>
                                                        <p>
                                                           	<!--<img src="assets/images/Imagens/timeline_form.jpg" alt="template" class="img-responsive" /> -->
                                                           	<img src="{{ asset('images/Imagens/timeline_form.jpg') }}" class="img-fluid" alt="Timeline Formulário">
                                                    </div>
                                                </div>  

                                                <div class="card" id="visualizacaoform">
                                                    <div class="card-body"> 
                                                        <h3>26.2 Relatório </h3>
                                                        <p> 
                                                            <br/> É possível o usuário realizar a geração de relatório, esse relatório listará as informações presentes na tela como por exemplo: Código do Formulário, Título, Status, etc. Para essa geração o usuário deve acessar <code>Formulários </code> -> <code> Visualizar Formulários </code> estará disponível as opção <code> Excel, PDF e Imprimir </code>.</p>
                                                        <p>
                                                            <!--<img src="assets/images/Imagens/relatorio_form.jpg" alt="template" class="img-responsive" /> -->
                                                            <img src="{{ asset('images/Imagens/relatorio_form.jpg') }}" class="img-fluid" alt="Relatório Formulário">
                                                    </div>
                                                </div>  

                                            </div>
                            	        </div>

                            	        <div class="card" id="revisaoform">
                                            <div class="card-body">
                                                 <h3>27. Revisão </h3>
                                                <p> 
                                                	<br/> Para realizar a revisão de um formulário, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code> -> <code> Ações </code> -> <code> Iniciar Revisão </code>.</p>
                                                <p>
                                                    <!--<img src="assets/images/Imagens/revisao_form.jpg" alt="template" class="img-responsive" /> -->
                                                    <img src="{{ asset('images/Imagens/revisao_form.jpg') }}" class="img-fluid" alt="Revisão Formulário">
                                                <p>
                                                    <br/> Qualquer usuário que tem acesso ao formulário pode iniciar a revisão. Ao iniciar a revisão o usuário se torna o elaborador do formulário. E nesse momento se inicia o fluxo do Workflow.</p>
                                            </div>
                                        </div>

                                       	<div class="card" id="divulgacaoform">
                                            <div class="card-body">	
                                                <h3>28. Divulgação </h3>
                                               <p> 
                                                	<br/> Após o setor de Processos realizar a aprovação o formulário, o Workflow de elaboração do formulário é finalizado e dispara uma notificação aos envolvidos na elaboração do formulário.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/divulgacao_form.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/divulgacao_form.jpg') }}" class="img-fluid" alt="Divulgação de Formulário"> 
                                        	</div>
                                        </div>









                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection
