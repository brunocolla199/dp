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
                                        <br/>A ferramenta foi construída com o intuito de automatizar o controle de elaboração dos documentos e formulários pelo setor da qualidade, onde todas as partes envolvidas na elaboração interajam com a ferramenta, assim centralizando todas as informações em um único lugar.</p>
                                   
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
                                    <h3>7. Grupos de Treinamento</h3>
                                    <p> 
                                    	<br/> O cadastro de grupo de treinamento está disponível no menu <code> Configurações </code> -> <code> Novo Agrupamento.</code> </p>
                                   <p>
                                        <!-- <img src="assets/images/Imagens/grupotreinamento.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/grupotreinamento.jpg') }}" class="img-fluid" alt="Grupo de Treinamento">
                                   <p>
										<br/> Campos a serem preenchidos na geração do documento: </p>
                                   <p>
                                   		<li>Nome do Agrupamento: definir o nome do novo grupo de treinamento.</li>
                                   		<li>Tipo de Agrupamento: definir o tipo como grupo de treinamento. </li>
                                   		<li>Descrição do Agrupamento: definir uma breve descrição sobre o grupo que está sendo criado. </li> 
                                   </p>
                              
                                    <div class="card" id="grupos">
                                         <div class="card-body">
                                             <h3>7.1. Vinculação de Usuários</h3>
                                             <p> 
                                    	         <br/> Para realizar a vinculação dos usuários ao grupo de treinamento deve-se acessar <code>Configuração </code> -> <code> Agrupamentos </code> -> <code> Grupos de Treinamento. </code> </p>
                                             <p>
                                                 <!-- <img src="assets/images/Imagens/vinculacao_usuario.jpg" alt="template" class="img-responsive" /> -->
                                                 <img src="{{ asset('images/Imagens/vinculacao_usuario.jpg') }}" class="img-fluid" alt="Vinculação de Usuários">
                                             <p>
                                   		         <br/> Selecionar o grupo de treinamento que será realizado a vinculação dos usuário e clicar sob o ícone <code> Vinculação </code> para selecionar os usuários. Conforme tela abaixo. </code> </p>
                                             <p>
                                   		         <!-- <img src="assets/images/Imagens/vinculacao_usuario1.jpg" alt="template" class="img-responsive" /> -->
                                   		         <img src="{{ asset('images/Imagens/vinculacao_usuario1.jpg') }}" class="img-fluid" alt="Vinculação de Usuários Grupo de Treinamento">
                                             <p>
                                   		         <br/> Após clique em <code> Atualizar Vinculações. </code> </p>
                                             <p>
                                        </div>
                                    </div> 
                                </div>
                            </div> 

                             <div class="card" id="grupos">
                                <div class="card-body">
                                    <h3>8. Grupos de Divulgação</h3>
                                    <p>
                                    	<br/> O cadastro de grupo de divulgação está disponível no menu <code> Configurações </code> -> <code> Novo Agrupamento.</code> </p>
                                   <p>
                                        <!-- <img src="assets/images/Imagens/grupodivulgacao.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/grupodivulgacao.jpg') }}" class="img-fluid" alt="Grupo de Divulgação">
                                   <p>
										<br/> Campos a serem preenchidos na geração do documento: </p>
                                   <p>
                                   		<li>Nome do Agrupamento: definir o nome do novo grupo de treinamento. </a></li>
                                   		<li>Tipo de Agrupamento: definir o tipo como grupo de treinamento. </a></li>
                                   		<li>Descrição do Agrupamento: definir uma breve descrição sobre o grupo que está sendo criado. </a></li>
                                   </p>
                               
                                  <div class="card" id="grupos">
                                       <div class="card-body">
                                             <h3>8.1. Vinculação de Usuários</h3>
                                             <p> 
                                    	        <br/> Para realizar a vinculação dos usuários ao grupo de divulgação deve-se acessar <code>Configuração </code> -> <code> Agrupamentos </code> -> <code> Grupos de Divulgação. </code> </p>
                                            <p>
                                                <!--<img src="assets/images/Imagens/vinculacao_divulgacao.jpg" alt="template" class="img-responsive" /> -->
                                                <img src="{{ asset('images/Imagens/vinculacao_divulgacao.jpg') }}" class="img-fluid" alt="Vinculação de Usuários">
                                            <p>
                                   		        <br/> Selecionar o grupo de divulgacão que será realizado a vinculação dos usuário e clicar sob o ícone <code> Vinculação </code> para selecionar os usuários. Conforme tela abaixo. </code> </p>
                                            <p>
                                   		        <!--<img src="assets/images/Imagens/vinculacao_divulgacao1.jpg" alt="template" class="img-responsive" /> -->
                                   		        <img src="{{ asset('images/Imagens/vinculacao_divulgacao1.jpg') }}" class="img-fluid" alt="Vinculação de Usuários Grupo de Divulgação">
                                            <p>
                                   		        <br/> Após clique em <code> Atualizar Vinculações. </code> </p>
                                            <p>
                                        </div>
                                    </div> 
                                </div>
                            </div> 

                            <div class="card" id="aprovadores">
                                <div class="card-body">
                                    <h3>9. Aprovadores</h3>
                                    <p> 
                                    	<br/> A vinculação dos usuários que serão aprovadores de cada setor da empresa está disponível em <code> Configuraçãoes </code> -> <code> Agrupamentos </code> -> <code> Aprovadores. </code> </p>
                                    <p>
                                        <!-- <img src="assets/images/Imagens/aprovadores.jpg" alt="template" class="img-responsive" /> -->
                                        <img src="{{ asset('images/Imagens/aprovadores.jpg') }}" class="img-fluid" alt="Aprovadores">
                                    <p>
                                   		
                                    <div class="card" id="aprovadores">
                                        <div class="card-body">
                                             <h3>9.1. Vinculação de Aprovadores</h3>
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
                                    <h3>10. Padrão de Códigos</h3>
                                   <p> 
                                    	<br/> A configuração do padrão de códigos está disponível no menu <code>Configuração </code> -> <code> Padrões </code>. </p>
                                   <p>
                                        <br/> No campo "Padrão para Número do Código de Documento:" deve ser informado a máscara que a aplicação deverá seguir para a geração dos códigos </p>
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
                                    <h3>11. Administrador Setor Qualidade</h3>
                                   <p> 
                                    	<br/> A configuração do usuário do setor da qualidade que terá acesso a aprovação dos documentos confidenciais está disponível no menu <code>Configuração </code> -> <code> Padrões </code>. </p>
                                   <p>
                                        <br/> No campo "Administrador - Setor Qualidade:" deve ser selecionado o usuário. Após clique no botão <code> Salvar </code>. </p>
                                   <p>
 									   <!-- <img src="assets/images/Imagens/confidencial.jpg" alt="template" class="img-responsive" /> -->
 									    <img src="{{ asset('images/Imagens/confidencial.jpg') }}" class="img-fluid" alt="Configuração Administrador Setor Qualidade">
                                   <p>
                                   		
                               </div>
                            </div>

                            <div class="card" id="elaboracao">
                                <div class="card-body">
                                    <h3>12. Elaboração </h3>
                                   <p> 
                                    	<br/> A elaboração de documentos está disponível no menu <code>Documentação </code> -> <code> Gerar Documentos </code>. </p>
                                   <p>
 									    <!--<img src="assets/images/Imagens/elaboracao.jpg" alt="template" class="img-responsive" /> -->
 									    <img src="{{ asset('images/Imagens/elaboracao.jpg') }}" class="img-fluid" alt="Elaboração de Documentos">
                                   <p>
                                        <br/> <li>Setor: definição do setor que está sendo elaborado o documento </a></li>
                                        <br/> <li>Tipo de Documento: definição do tipo de documento que está sendo elaborador ( Instrução de Trabalho, Procedimento de Gestão ou Diretriz de Gestão). </a></li>
                                        <br/> <li>Acesso: definição do acesso aos documentos (Livre, Restrito e Confidencial). </a></li> </p>
                                        <div class="alert alert-info">Livre: Todos os envolvidos na elaboração do documento e qualquer outro usuário não participou se sua elaboração terão acesso a visualizar o documento após sua finalização.</p>
                                        Restrito: Todos os envolvidos na elaboração do documento e o setor que pertence o documento terão acesso a visualizar o documento após sua finalização. </p>
                                        Confidencial: Todos os envolvidos na elaboração do documento terão acesso a visualizar o documento após sua finalização.
                                        </div>                 
                                        <br/> <li>Aprovador: responsável por realizar a aprovação do documento. </a></li>
                                        <br/> <li>Área de Interesse: definição do setor / usuário que fazem parte da elaboração do documento. </a></li>
                                        <br/> <li>Grupo de Treinamento: definição do grupo responsável por treinar os integrantes. </a></li>
                                        <br/> <li>Grupo de Divulgação: definição do grupo de usuários que participaram da revisão de documento, onde após a finalização do documentotodos deveram ser notificados. </a></li>
                                        <br/> <li>Validade do Documento: definição da validade do documento. </a></li>
                                        <br/> <li>Cópia Controlada: opção para definir se após a finalização do documento a qualidade será notificada para realizar a impressão das cópias controladas. </a></li>
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
                                   		<img src="{{ asset('images/Imagens/anexos.jpg') }}" class="img-fluid" alt="Envio do Documento a Qualidade"> 
                                   <p>
                                   		<br/> Após realiar a inclusão dos anexos ao documento, deve clicar em <code> Concluir e Enviar à Qualidade</code>, nesse momento o documento é encaminhado para o próximo setor para análise do documento. 
                                   <p>
                                   		<div class="alert alert-warning">NOTA: <li>A inclusão de anexos aos documentos não é obrigatória.</a></li>.</div>

                                   		<!--<img src="assets/images/Imagens/envio_documento.jpg" alt="template" class="img-responsive" /> -->
                                   		<img src="{{ asset('images/Imagens/envio_documento.jpg') }}" class="img-fluid" alt="Envio do Documento a Qualidade">                                         
                               </div>
                            </div>

                             <div class="card" id="criar">
                                <div class="card-body">
                                    <h3>13. Criar</h3>
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
                                    <h3>14. Importar</h3>
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
                                        <h3>15. Editor </h3>
                                               <p> 
                                                	<br/> Para realizar a edição de um documento, deve-se selecionar o texto que serpa realizado a alteração e após clicar sobre a opção que será utilizada. Como por exemplo: Alteração de cor, alteração de fonte, tamanho da letra, etc. </p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/editor.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/editor.jpg') }}" class="img-fluid" alt="Formatação do Texto">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="qualidade">
                                            <div class="card-body">
                                                <h3>16. Qualidade</h3>
                                               <p> 
                                                	<br/> Após o documento ser elaborador o mesmo é encaminhado a Qualidade para iniciar o Workflow de aprovação do documento. A qualidade será notificada que possui um novo documento para ser analisado. Conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/qualidade_not.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/qualidade_not.jpg') }}" class="img-fluid" alt="Notificação Qualidade">
                                               <p>
                                               		<br/> É possível através da notificação acessar o documento para realizar a análise. </p>
                                               <p>

                                                <div class="card" id="qualidade">
                                                    <div class="card-body">
                                                        <h3>16.1 Rejeitar um Documento</h3>
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
                                                       		<br/>Nesse momento o elaborador visualiza as informações sugeridas pela Qualidade, realiza as correções e segue com o Workflow, enviando novamente a Qualidade para análise.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/rejeicao.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/rejeicao.jpg') }}" class="img-fluid" alt="Correção das sugestões">
                                                       	<p>
                                                    </div>
                                                </div>

                                                <div class="card" id="qualidade">
                                                    <div class="card-body">
                                                        <h3>16.2 Aprovar Documento</h3>
                                                       <p> 
                                                        	<br/> Para realizar a aprovação de um documento, o usuário deve clicar em Aprovar, nesse momento o documento é encaminhado para o proxímo passo do Workflow para análise do documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/aprovado.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/aprovado.jpg') }}" class="img-fluid" alt="Documento Aprovado">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="qualidade">
                                                    <div class="card-body">
                                                        <h3>16.3 Tornar Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para tornar um documento obsoleto,  o usuário deve clicar em Tornar Obsoleto, nesse momento o sistema mostrará em tela uma mensagem de confirmação para tornar o documento obsoleto ou não.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/tornar_obsoleto.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/tornar_obsoleto.jpg') }}" class="img-fluid" alt="Documento Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="qualidade">
                                                    <div class="card-body">
                                                        <h3>16.4 Desfazer Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para desfazer o documento que está obsoleto,  o usuário deve clicar em Ativar Documento, nesse momento o sistema mostrará em tela uma mensagem de confirmação para ativar o documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/desfazer_obsoleto.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/desfazer_obsoleto.jpg') }}" class="img-fluid" alt="Documento Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                 <div class="card" id="qualidade">
                                                    <div class="card-body">
                                                        <h3>16.5 Víncular Formulários</h3>
                                                       <p> 
                                                        	<br/> Para realizar a vinculação de formulários a documentos, o usuário deve clicar em Víncular Formulários, nesse momento o sistema mostrará em tela uma mensagem de confirmação para ativar o documento.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/vincular_form.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/vincular_form.jpg') }}" class="img-fluid" alt="Víncular Formulário">
                                                       <p>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div> 

                                        <div class="card" id="areainteresse">
                                            <div class="card-body">
                                                <h3>17. Área de Interesse</h3>
                                                <p> 
                                                   	<br/> Após o documento ser aprovado pela Qualidade, a Área de Interesse será notificada que possui um novo documento para analisar.</p>
                                                <p>
                                                	<br/> O processo de aprovação e rejeição do documento é o mesmo demonstrado no menu <code> Qualidade</code>
                                                <p>

                                            </div> 
                                        </div>

                                        <div class="card" id="aprovador">
                                            <div class="card-body">
                                                <h3>18. Aprovador</h3>
                                               <p> 
                                                	<br/> Após o documento ser aprovado pela Qualidade, o Aprovador será notificado que possui um novo documento para analisar.</p>
                                               <p>
                                               		<br/> O processo de aprovação e rejeição do documento é o mesmo demonstrado no menu <code> Qualidade</code>
                                               <p>
                                            </div>
                                        </div> 

                                        <div class="card" id="listadepresenca">
                                            <div class="card-body">
                                                <h3>19. Lista de Presença</h3>
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
                                                <h3>20. Pessoas & Organizações</h3>
                                               <p> 
                                                	<br/> Após o Elaborador realizar o upload da lista de presença, o setor de Pessoas deve realizar a análise. O setor de Pessoas será avisado quando receber uma nova lista de presença para ser analisada.</p>
                                               <p>
                                               		<br/> É possível através da notificação acessar o documento para realizar a análise. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/aprovacao_lista.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/aprovacao_lista.jpg') }}" class="img-fluid" alt="Aprovação da Lista de Presença">
                                               <p>
                                               		<br/> O setor de Pessoas poderá Rejeitar ou Aprovar a lista de presença.</p>
                                               		<div class="alert alert-info">Rejeitar: será habilitado uma caixa para informar a justificativa da rejeição e a lista retorna ao Elaborador para ajustes.</p>
                                                    Aprovar: será realizado a divulgação do documento. </p>
                                                    </div>         
                                            </div>
                                        </div>

                                         <div class="card" id="divulgacao">
                                            <div class="card-body">
                                                <h3>21. Divulgação </h3>
                                               <p> 
                                                	<br/> Após o setor de Pessoas realizar a aprovação da lista de presença, o Workflow de elaboração do documento é finalizado e dispara uma notificação aos envolvidos na elaboração do documento.</p>
                                               <p>
                                               		
                                               		<!--<img src="assets/images/Imagens/divulgacao.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/divulgacao.jpg') }}" class="img-fluid" alt="Divulgação do Documento">
                                               <p>
                                            </div>
                                        </div> 

                                        <div class="card" id="visualizacao">
                                            <div class="card-body">
                                                <h3>22. Visualização </h3>
                                               <p> 
                                                	<br/> Para visualizar os documentos existentes na aplicação, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code>.</p>
                                               <p>
                                               		
                                               		<!--<img src="assets/images/Imagens/visualizacao.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/visualizacao.jpg') }}" class="img-fluid" alt="Visualização do Documento">
                                               <p>
                                               		<li>Tipo de Documento;</li>
                                               		<li>Setor;</li>
                                               		<li>Grupo de Divulgação;</li>
                                               		<li>Grupo de Treinamento;</li>
                                               		<li>Data de Validade;</li>
                                               		<li>Título do Documento.</li>
                                               <p>

                                               <div class="card" id="visualizacao">
                                                    <div class="card-body">
                                                         <h3>22.1 Status </h3>
                                                        <p> 
                                                    	   <br/> Para visualizar o status dos documentos, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code>.</p>
                                                        <p>
                                                   		
                                                   		   <!--<img src="assets/images/Imagens/status.jpg" alt="template" class="img-responsive" /> -->
                                                   		   <img src="{{ asset('images/Imagens/status.jpg') }}" class="img-fluid" alt="Status do Documento">
                                                        <p>
                                                   		   <br/> Além da visualização na tela inicial, é possível ao acessar o documento visualizar a linha do tempo do documento, todo seu histórico desde sua criação.</p>
                                                        <p>
                                                   		   <!--<img src="assets/images/Imagens/timeline.jpg" alt="template" class="img-responsive" /> -->
                                                   		   <img src="{{ asset('images/Imagens/timeline.jpg') }}" class="img-fluid" alt="Timeline do Documento">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div> 

                                        <div class="card" id="revisao">
                                            <div class="card-body">
                                                <h3>23. Revisão </h3>
                                                <p> 
                                            	    <br/> Para realizar a revisão de um documento, deve-se acessar <code> Documentação </code> -> <code> Visualizar Documento </code> -> <code> Ações </code> -> <code> Solicitar Revisão </code>.</p>
                                                <p>
                                                   		
                                                    <!--<img src="assets/images/Imagens/revisao.jpg" alt="template" class="img-responsive" /> -->
                                                    <img src="{{ asset('images/Imagens/revisao.jpg') }}" class="img-fluid" alt="Revisão Documento">
                                                <p>
                                                    <br/> Qualquer usuário que tem acesso ao documento pode realizar a solicitação de revisão. Ao solicitar a revisão o usuário se torna o elaborador do documento. E nesse momento se inicia o fluxo do Workflow.</p>
                                           
										<div class="card" id="revisao">
                                            <div class="card-body">
                                                <h3>23.1 Cancelar Revisão </h3>
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
                                                	<div class="alert alert-warning">NOTA: <li>Somente os usuários da Qualidade tem permissão para cancelar a revisão de um documento. </a></li>.</div>
                                                </p>
                                            </div>
                                        	</div>
    									</div>
                                        	</div>

                                        <div class="card" id="formularios">
                                            <div class="card-body">
                                                <h3>24. Elaboração </h3>
                                                <p> 
                                                    <br/> A elaboração de formulário está disponível no menu <code> Formulário </code> -> <code> Novo Formulário </code>.</p>
                                                <p>
                                                   		
                                                   	<!--<img src="assets/images/Imagens/formularios.jpg" alt="template" class="img-responsive" /> -->
                                                   	<img src="{{ asset('images/Imagens/formularios.jpg') }}" class="img-fluid" alt="Elabração de Formulários">
                                                <p>
                                                   	<br/> Campos a serem preenchidos na elaboração do formulário:</p>
                                                   	<li> Setor: definição do setor que está sendo elaborado o documento.</li>
                                                   	<li> Grupo de Divulgação: definição do tipo de documento que está sendo elaborador ( Instrução de Trabalho, Procedimento de Gestão ou Diretriz de Gestão).</li>
                                                   	<li> Acesso: definição do acesso aos documentos (Livre e Restrito).</li>
                                                   	<li> Título do Formulário: descrição do nome do formulário.</li>
                                                <p>
                                                   	<br/> Após preencher todos os campos o Elaborador realizará a Importação do Formulário. </p>
                                            </div>
                                        </div> 

                                        <div class="card" id="importarform">
                                            <div class="card-body">	
                                                <h3>25.Importar </h3>
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
                                               		<br/>O Elaborador deve selecionar o arquivo e clicar em "Salvar Formulário", onde será encaminhado ao setor da Qualidade para análise. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/elaboracao_form"template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/elaboracao_form.jpg') }}" class="img-fluid" alt="Elaboração Formulário">
                                            </div>
                                        </div> 

                                        <div class="card" id="qualidadeform">
                                            <div class="card-body">	
                                                <h3>26.Qualidade </h3>
                                               <p> 
                                                	<br/> A Qualidade será notificada que recebeu um novo formulário para análise. Conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/qualidade_form.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/qualidade_form.jpg') }}" class="img-fluid" alt="Notificação Qualidade">
                                               <p>
                                               		<br/>É possível através da notificação acessar o documento para realizar a análise.</p>
                                              
                                                <p>
                                               		<!--<img src="assets/images/Imagens/formulario_qua.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/formulario_qua.jpg') }}" class="img-fluid" alt="Formulários">
                                        	
                                               	<p>
                                        			<br/> A Qualidade poderá Rejeitar ou Aprovar a lista de presença.</p>
                                               		<div class="alert alert-info">Rejeitar: será habilitado uma caixa para informar a justificativa da rejeição e o formulário retorna ao Elaborador para ajustes.</p>
                                                    Aprovar: será realizado a divulgação do formulário. </p>
                                                    </div>  

                                             <div class="card" id="qualidadeform">
                                                    <div class="card-body">
                                                        <h3>26.1 Tornar Obsoleto</h3>
                                                       <p> 
                                                        	<br/> Para tornar um formulário obsoleto,  o usuário deve clicar em Tornar Obsoleto, nesse momento o sistema mostrará em tela uma mensagem de confirmação para tornar o formulário obsoleto ou não.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/tornar_obsoleto_form.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/tornar_obsoleto_form.jpg') }}" class="img-fluid" alt="Formulário Obsoleto">
                                                       <p>
                                                    </div>
                                                </div> 

                                                <div class="card" id="qualidadeform">
                                                    <div class="card-body">
                                                        <h3>26.2 Desfazer Obsoleto</h3>
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
                                                <h3>27. Visualização </h3>
                                                <p> 
                                                    <br/> Para visualizar os formulários existentes na aplicação, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code>.</p>
                                                <p>
                                                   	<!--<img src="assets/images/Imagens/visualizar_form.jpg" alt="template" class="img-responsive" /> -->
                                                   	<img src="{{ asset('images/Imagens/visualizar_form.jpg') }}" class="img-fluid" alt="Visualização de Formulário"> 

                                                <div class="card" id="visualizacaoform">
                                                    <div class="card-body">	
                                                        <h3>27.1 Status </h3>
                                                        <p> 
                                                            <br/> Para visualizar o status dos formulários, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code>.</p>
                                                        <p>
                                                           	<!--<img src="assets/images/Imagens/status_form.jpg" alt="template" class="img-responsive" /> -->
                                                           	<img src="{{ asset('images/Imagens/status_form.jpg') }}" class="img-fluid" alt="Status Formulário">
                                                        <p>
                                                           	<br/> Além da visualização na tela inicial, e possível ao acessar o documento visualizar a linha do tempo do documento, todo o seu histórico desde sua criação. </p>
                                                        <p>
                                                           	<!--<img src="assets/images/Imagens/timeline_form.jpg" alt="template" class="img-responsive" /> -->
                                                           	<img src="{{ asset('images/Imagens/timeline_form.jpg') }}" class="img-fluid" alt="Timeline Formulário">
                                                    </div>
                                                </div>  
                                            </div>
                            	        </div>

                            	        <div class="card" id="revisaoform">
                                            <div class="card-body">
                                                 <h3>28. Revisão </h3>
                                                <p> 
                                                	<br/> Para realizar a revisão de um formulário, deve-se acessar <code> Formulários </code> -> <code> Visualizar Formulários </code> -> <code> Ações </code> -> <code> Solicitar Revisão </code>.</p>
                                                <p>
                                                    <!--<img src="assets/images/Imagens/revisao_form.jpg" alt="template" class="img-responsive" /> -->
                                                    <img src="{{ asset('images/Imagens/revisao_form.jpg') }}" class="img-fluid" alt="Revisão Formulário">
                                                <p>
                                                    <br/> Qualquer usuário que tem acesso ao formulário pode realizar a solicitação de revisão. Ao solicitar a revisão o usuário se torna o elaborador do formulário. E nesse momento se inicia o fluxo do Workflow.</p>
                                            </div>
                                        </div>

                                       	<div class="card" id="divulgacaoform">
                                            <div class="card-body">	
                                                <h3>29. Divulgação </h3>
                                               <p> 
                                                	<br/> Após a Qualidade realizar a aprovação o formulário, o Workflow de elaboração do formulário é finalizado e dispara uma notificação aos envolvidos na elaboração do formulário.</p>
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
