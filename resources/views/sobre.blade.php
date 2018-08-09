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
                                        <br/> O sistema é compatível com os navegadores Chrome (preferencialmente) e Firefox. Para acessar segue link completo de acesso: <code>http://18.209.80.61/qualidade_prod/login</code></p>
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
                                   		<div class="alert alert-warning">NOTE: <li>Código do Documento: será gerado automaticamente pela aplicação. </a></li>.</div>
 								   <p>
 										<br/> Após preencher todos os campos o Elaborador poderá: </p>
                                   <p>
                                   		<br/> <li>Criar um documento através do Editor da aplicação. </a></li>
                                   		<br/> <li>Importar um documento já existente. </a></li>  
                                   <p>
                                   		<br/> O Elaborador insere as informações no documento, e após deve clicar em <code> Salvar Documento</code>, nesse momento o documento é encaminhado para o próximo setor para análise do documento. 
                                   <p>
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
                              	
                                         <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.1. Formatação do Texto</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração da formatação do texto como Normal e Título, deve-se selecionar o texto que será realizado a alteração e clicar no campo conforme tela abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/formatacaokk.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/formatacao.jpg') }}" class="img-fluid" alt="Formatação do Texto">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.2. Fontes</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração da fonte do documento, deve-se selecionar o texto que será realizado a alteração na fonte e clicar no campo "Fonte" para escolha da nova fonte. Conforme tela abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/fonte.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/fonte.jpg') }}" class="img-fluid" alt="Fonte">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.3. Tamanho</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração do tamanho da fonte do documento, deve-se selecionar o texto que será realizado a alteração do tamanho da fonte e clicar no campo "Tamanho" para escolha do novo tamanho. Conforme tela abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/tamanho.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/tamanho.jpg') }}" class="img-fluid" alt="Tamanho">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.4. Negrito, Itálico, Sublinhado e Tachado</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração do texto do documento, deve-se selecionar o texto e clicar nas opções conforme imagem abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/negrito.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/negrito.jpg') }}" class="img-fluid" alt="Negrito, Itálico, Sublinado e Tachado">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.5. Alterar Cor</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração da cor do texto no documento, deve-se selecionar o texto e clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/cor.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/cor.jpg') }}" class="img-fluid" alt="Alteração de Cor">
                                               <p>
                           
                                                <div class="card" id="editor">
                                                    <div class="card-body">
                                                        <h3>15.5.1. Personalização da Cor</h3>
                                                       <p> 
                                                        	<br/> Para selecionar uma cor diferenciada das apresentadas na paleta de cores, deve-se clicar na opção <code>"Mais Cores..."</code>, e informar o código da cor conforme imagem abaixo. Lebrando que sempre antes do código deve ser informado o sinal <code>#</code> para compor o código, no campo "Cor Selecionada" trará a cor conforme o código digitado.</p>

                    										<br/> <li>Exemplo: #173A64 </a></li> </p>
                                                        
                                                       <p>
                                                       		<!-- <img src="assets/images/Imagens/personalizar.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/personalizar.jpg') }}" class="img-fluid" alt="Personalização da Cor">
                                                       <p>
                                                    </div>
                                                </div>
                             	            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.6. Alterar cor de fundo do texto</h3>
                                               <p> 
                                                	<br/> Para realizar a alteração do fundo do texto, deve-se selecionar o texto e clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/fundo.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/fundo.jpg') }}" class="img-fluid" alt="Alteração da cor de fundo do texto">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.7. Alinhamento do Texto</h3>
                                               <p> 
                                                	<br/> Para realizar o alinhamento do texto, deve-se selecionar o texto e clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!-- <img src="assets/images/Imagens/alinhamento.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/alinhamento.jpg') }}" class="img-fluid" alt="Alinhamento do Texto">
                                               <p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.8. Lista Numerada</h3>
                                               <p> 
                                                	<br/> Para realizar a inserção da lista numerada no corpo do documento, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/lista.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/lista.jpg') }}" class="img-fluid" alt="Lista Numerada">
                                               <p>
                                               		<br/> Funções disponíveis na lista numerada:</p>
                                               		<br/> <li>Tab: Ao pressionar o Tab do teclado a numeração avança a sequência exemplo. </a></li> </p>
                                               		<!--<img src="assets/images/Imagens/lista_tab.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/lista_tab.jpg') }}" class="img-fluid" alt="Lista Numerada com Tab"> </p>
                                               		<br/> <li>Enter: Ao pressionar o Enter do teclado a numeração retrocede a sequência exemplo. </a></li> </p>
                                               		<!--<img src="assets/images/Imagens/lista_enter.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/lista_enter.jpg') }}" class="img-fluid" alt="Lista Numerada COm Enter"> </p>
                                               		<br/> <li>Shift+Enter: Ao pressionar o Shift+Enter do teclado épossível incluir texto entre a sequência de numeração, conforme exemplo abaixo. </a></li> </p>
                                               		<!--<img src="assets/images/Imagens/lista_shift_enter.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/lista_shift_enter.jpg') }}" class="img-fluid" alt="Lista Numerada Shift+Enter"> </p>
                                               <p>

                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.9. Marcadores</h3>
                                               <p> 
                                                	<br/> Para realizar a inserção de marcadores no corpo do documento, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/marcadores.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/marcadores.jpg') }}" class="img-fluid" alt="Marcadores">
                                               <p>

                                                <div class="card" id="editor">
                                                    <div class="card-body">
                                                        <h3>15.9.1 Alteração do Marcador</h3>
                                                       <p> 
                                                        	<br/> Para realizar a alteração do marcador deve-se clicar sobre o marcado e acessar as propriedades, conforme imagem abaixo.</p>
                                                       <p>
                                                       		<!--<img src="assets/images/Imagens/alterar_marcador.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/alterar_marcador.jpg') }}" class="img-fluid" alt="Alteração do Marcador">
                                                       <p>  

                                                       		<br/> Após selecionar o tipo do marcador.</p>
                                                       		<!--<img src="assets/images/Imagens/tipo_marcador.jpg" alt="template" class="img-responsive" /> -->
                                                       		<img src="{{ asset('images/Imagens/tipo_marcador.jpg') }}" class="img-fluid" alt="Tipo do Marcador">
                                                       	<p>
                                                       		<br/> Clique em ok.</p> 	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.10. Recuo do Texto</h3>
                                               <p> 
                                                	<br/> Para realizar o recuo do texto, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/recuo.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/recuo.jpg') }}" class="img-fluid" alt="Recuo do Texto">
                                              
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.11. Inserir Imagem</h3>
                                              <p> 
                                                	<br/> Para realizar a inclusão de imagem no corpo do documento, deve-se clicar na opção conforme imagem abaixo.</p>
                                              <p>
                                               		<!--<img src="assets/images/Imagens/imagem.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/imagem.jpg') }}" class="img-fluid" alt="Inserção de Imagem">
                                              <p>
                                              		<br/> Abrirá a tela para selecionar a imagem.</p>
                                              <p>
                                              		<!--<img src="assets/images/Imagens/selecionar.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/selecionar.jpg') }}" class="img-fluid" alt="Seleção de Imagem">
                                              <p>
                                              		<br/> Ao clicar em Localizar no Servidor, será mostrado em tela as imagens já utilizadas em outros documentos, para carregar uma nova imagem clique em <code>Enviar Arquivo </code> -> Selecione a imagem -> <code>Abrir </code>. </p>
                                              <p>
                                              		<!--<img src="assets/images/Imagens/enviar_imagem.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/enviar_imagem.jpg') }}" class="img-fluid" alt="Envio da Imagem">
                                              <p>
                                               		<br/> A imagem será carregada na tela e após deve-se clicar sob a imagem e clicar no botão Usar.</p>
                                              <p>
                                              		<!--<img src="assets/images/Imagens/usar_imagem.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/usar_imagem.jpg') }}" class="img-fluid" alt="Usar Imagem">
                                              <p>
                                              		<br/> A imagem será carregada na tela para ajustar largura, altura, etc. Após clique em "Ok", para a imagem ser atribuída ao documento.</p>
                                              <p>
                                              		<!--<img src="assets/images/Imagens/ajustar_imagem.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/ajustar_imagem.jpg') }}" class="img-fluid" alt="Ajustar Imagem">
                                              </p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.12. Inserir Tabela</h3>
                                               <p> 
                                                	<br/> Para realizar a inclusão de tabela no corpo do documento, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/tabela.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/tabela.jpg') }}" class="img-fluid" alt="Inserção de Tabela">
                                               <p>
                                               		<br/> Abrirá a tela para informar total de linhas e colunas a ser atribuidas a tabela que está sendo criada. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/linhas_tabela.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/linhas_tabela.jpg') }}" class="img-fluid" alt="Definição da Tabela">
                                               <p>
                                               		<br/> Após clique em Ok. </p>
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.13. Quebra de Página</h3>
                                               <p> 
                                                	<br/> Para realizar a quebra de página, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/quebra.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/quebra.jpg') }}" class="img-fluid" alt="Quebra de Página">
                                               <p>
                                               		
                                            </div>
                                        </div>

                                        <div class="card" id="editor">
                                            <div class="card-body">
                                                <h3>15.14. Inserir Caractere Especial</h3>
                                               <p> 
                                                	<br/> Para realizar a inserção de uma caractere especial, deve-se clicar na opção conforme imagem abaixo.</p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/caractere.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/caractere.jpg') }}" class="img-fluid" alt="Caractere Especial">
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

                                        <div class="card" id="capital">
                                            <div class="card-body">
                                                <h3>20. Capital Humano</h3>
                                               <p> 
                                                	<br/> Após o Elaborador realizar o upload da lista de presença, o Capital Humano deve realizar a análise. O Capital Humano será avisado quando receber uma nova lista de presença para ser analisada.</p>
                                               <p>
                                               		<br/> É possível através da notificação acessar o documento para realizar a análise. </p>
                                               <p>
                                               		<!--<img src="assets/images/Imagens/aprovacao_lista.jpg" alt="template" class="img-responsive" /> -->
                                               		<img src="{{ asset('images/Imagens/aprovacao_lista.jpg') }}" class="img-fluid" alt="Aprovação da Lista de Presença">
                                               <p>
                                               		<br/> O Capital Humano poderá Rejeitar ou Aprovar a lista de presença.</p>
                                               		<div class="alert alert-info">Rejeitar: será habilitado uma caixa para informar a justificativa da rejeição e a lista retorna ao Elaborador para ajustes.</p>
                                                    Aprovar: será realizado a divulgação do documento. </p>
                                                    </div>         
                                            </div>
                                        </div>

                                         <div class="card" id="divulgacao">
                                            <div class="card-body">
                                                <h3>21. Divulgação </h3>
                                               <p> 
                                                	<br/> Após o Capital Humano realizar a aprovação da lista de presença, o Workflow de elaboração do documento é finalizado e dispara uma notificação aos envolvidos na elaboração do documento.</p>
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
                                                   	<li> Grupo de Divulgação: definição do tipo de documento que está sendo elaborador ( Instrução de Trabalho, Procedimento de Gestão ou Diretriz de Gestão).</li>
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
                                               		<br/>O Elaborador deve selecionar o arquivo e clicar em "Salvar Formulário", onde será encaminhado ao setor da Qualidade para análise. </p>
                                               <p>
                                               		<img src="{{ asset('images/Imagens/elaboracao_form.jpg') }}" class="img-fluid" alt="Elaboração Formulário">
                                            </div>
                                        </div> 

                                        <div class="card" id="qualidadeform">
                                            <div class="card-body">	
                                                <h3>25.Qualidade </h3>
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

                                                <div class="card" id="visualizacaoform">
                                                    <div class="card-body">	
                                                        <h3>26.1 Status </h3>
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

                                       	<div class="card" id="divulgacaoform">
                                            <div class="card-body">	
                                                <h3>27. Divulgação </h3>
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
