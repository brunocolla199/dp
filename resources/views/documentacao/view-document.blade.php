@extends('layouts.app')

@section('content')

    <!-- O que fazer nestas situações? -->
    
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">

	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-6 col-6 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Documento</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('documentacao') }}">Documentação</a></li>
                        <li class="breadcrumb-item active">Visualização de Documento</li>
                    </ol>
                </div>
                <div class="col-3">
                    <button class="btn btn-lg btn-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Ver Linha do Tempo</button>
                </div>
                <?php $revisoes = \App\Classes\Helpers::instance()->getListAllReviewsDocument($nome); ?>
                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  count($revisoes) > 1)
                    <div class="col-3">
                        <button class="btn btn-lg btn-warning" type="button" data-toggle="collapse" data-target="#revisoesDoc" aria-expanded="false" aria-controls="revisoesDoc">Revisões Anteriores</button>
                    </div>
                @endif
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">
                
                <!-- Card "Documento em Revisão" -->
                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  !$necessita_revisao  &&  $em_revisao  )    
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Este documento está em revisão -  Validade: <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $validadeDoc)->format('d/m/Y') }}</b>  </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="card-text">Você pode cancelar a revisão à qualquer momento clicando no botão ao lado.</p>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#confirm-cancel-review-modal" data-backdrop="static">Cancelar Revisão</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Card Principal -->
                <div class="col-md-12 card" style="min-height: 600px">
                    <div class="card-body">

                        <!-- Timeline do Documento -->
                        <div class="row">
                            <div class="col col-centered">
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class="card card-body text-center">

                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="row" style="font-size:14px">
                                                    <div class="form-group col-md-12">
                                                        <?php \Carbon\Carbon::setLocale('pt_BR') ?>
                                                        
                                                        <ul class="timeline text-center">
                                                            @foreach( \App\Classes\Helpers::instance()->getHistoricoDocumento($document_id) as $key => $hist )
                                                                <li class=" {{ $key%2 == 0 ? 'timeline-inverted' : '' }}">
                                                                    <div class="timeline-badge success"  >
                                                                        <i class="mdi mdi-file-document"></i>
                                                                    </div>
                                                                    <div class="timeline-panel">
                                                                        <div class="timeline-heading">
                                                                            <h4 class="timeline-title">{{ ($hist->nome_usuario_responsavel != null) ? $hist->nome_usuario_responsavel : 'Usuário Inválido' }}</h4>
                                                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ $hist->created_at->diffForHumans() }}</small> </p>
                                                                        </div>
                                                                        <div class="timeline-body">
                                                                            <p>{{ $hist->descricao }}</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach     
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revisões do Documento -->
                        <div class="row">
                            <div class="col col-centered">
                                <div class="collapse multi-collapse" id="revisoesDoc">
                                    <div class="card card-body text-center">

                                        <div class="row">
                                           <div class="col-md-12 col-sm-12 p-20">
                                                <h3 class="card-title text-success">Revisões do documento: <b>{{ $nome }}</b></h3>
                                                <div class="list-group">
                                                    @if(count($revisoes) > 1)
                                                        @foreach($revisoes as $rev)
                                                            {!! Form::open(['route' => 'documentacao.make-doc-from-name', 'method' => 'POST', 'target' => '_blank']) !!}
                                                                {!! Form::hidden('nome', $rev) !!}
                                                                {!! Form::hidden('tipo_doc', $tipo_doc) !!}
                                                                {!! Form::hidden('document_id', $document_id) !!}
                                                                <button type="submit" class="list-group-item btn-block mt-3">  <span style="font-size: 20px">Revisão <b>{{ explode(".html", explode("_rev", $rev)[1])[0] }}</b>:</span> {{ explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $rev)[0] }}  </button>
                                                            {!! Form::close() !!}
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($necessita_revisao && Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE)
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <center>
                                        <div class="col-md-8">
                                            <h3 class="text-info">Existe uma solicitação de revisão para este documento!</h3>
                                            <h4 class="text-info">Por favor, informe o que você deseja fazer:</h4>

                                            <div class="row mt-3">
                                                <div class="col-md-2"></div>
                                                
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#reject-request-review-modal">REJEITAR <i class="fa fa-remove"></i></button>
                                                </div>
                                                <div class="col-md-4">    
                                                    <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#approves-request-review-modal" data-backdrop="static">APROVAR <i class="fa fa-check"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </center>
                                    <hr class="mt-4">
                                </div>
                            </div>

                            <div class="row h-100">
                                <iframe src="{{ asset('plugins/onlyoffice-php/doceditor.php?fileID=').$docPath.'&type=embedded' }}" frameborder="0" width="100%" height="600px"></iframe>
                            </div>

                            <!-- Se o documento ainda não estiver finalizado, pode inserir observações | Qualidade e Elaborador sempre podem adicionar anexos -->
                            <div class="row mt-4">
                                @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                    </div>
                                @endif
                                <div class="col-md-3">    
                                </div>
                                <div class="col-md-4">    
                                </div>
                                <div class="col-md-3 ">
                                </div>
                            </div>

                        @else

                            @if($finalizado)
                                
                                @if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                <div class="col-md-12 text-right">
                                    <a href="{{ asset('plugins/onlyoffice-php/Storage').'/'.$docPath }}" target="_blank" id="down-doc" class="btn col-md-2 btn-info"> <i class="mdi mdi-cloud-download"></i> Download</a>
                                </div>
                                <br>
                                @endif

                                <!-- Cards de justificativa para o solicitante de revisão: rejeição e cancelamento -->
                                @if(  ($justificativa_rejeicao_revisao != null && $justificativa_rejeicao_revisao != "") &&  Auth::user()->id == $id_usuario_solicitante  &&  !$em_revisao ) 
                                    <div class="col-md-12" id="justification-reject-review-div">
                                        <div class="row text-center">
                                            <div class="col-md-9">
                                                <div class="ribbon-wrapper card ">
                                                    <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE REJEIÇÃO DA REVISÃO</div> 
                                                    <p class="ribbon-content"><b>Qualidade:</b> {{ $justificativa_rejeicao_revisao }} </p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 d-flex flex-column">    
                                                <button type="button" id="ok-justify-reject" class="btn btn-block btn-lg btn-secondary mt-3">Ok, entendi</button>
                                            </div>

                                        </div>
                                    </div>
                                @elseif( ($justificativa_cancelar_revisao != null && $justificativa_cancelar_revisao != "") &&  Auth::user()->id == $id_usuario_solicitante  &&  !$necessita_revisao )
                                    <div class="col-md-12" id="justification-cancel-review-div">
                                        <div class="row text-center">
                                            <div class="col-md-9">
                                                <div class="ribbon-wrapper card ">
                                                    <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE CANCELAMENTO DA REVISÃO</div> 
                                                    <p class="ribbon-content"><b>Qualidade:</b> {{ $justificativa_cancelar_revisao }} </p>
                                                </div>
                                            </div>

                                            <div class="col-md-3 d-flex flex-column">    
                                                <button type="button" id="ok-justify-cancel" class="btn btn-block btn-lg btn-secondary mt-3">Ok, entendi</button>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                <div class="row h-100">
                                    <iframe src="{{ asset('plugins/onlyoffice-php/doceditor.php?fileID=').$docPath.'&type=embedded' }}" frameborder="0" width="100%" height="600px"></iframe>
                                </div>

                                <!-- Qualidade e Elaborador sempre podem adicionar anexos -->
                                <div class="row mt-4">
                                    @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                        </div>
                                    @endif
                                    <div class="col-md-3">    
                                    </div>
                                    <div class="col-md-4">    
                                    </div>
                                    <div class="col-md-3 ">
                                    </div>
                                </div>

                            @elseif( $etapa_doc >= Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM && $etapa_doc <= Constants::$ETAPA_WORKFLOW_APROVADOR_NUM )

                                <!-- Div com os botões de aprovar ou rejeitar -->
                                @if( $etapa_doc == Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM && $elaborador_id == Auth::user()->id) 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row text-center">
                                                <div class="col-md-8">
                                                    @if( isset($justificativa) && $justificativa != "''" && $justificativa != "")
                                                        <div class="ribbon-wrapper card ">
                                                            <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE REJEIÇÃO</div> 
                                                            <p class="ribbon-content"> {{ $justificativa }} </p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 align-middle">    
                                                    {{ Form::open(['route' => 'documentacao.resend-document', 'method' => 'POST']) }}
                                                        {{ Form::hidden('documento_id', $document_id) }}
                                                        {{ Form::hidden('etapa_doc', $etapa_doc) }}
                                                        {!! Form::button('REENVIAR <i class="fa fa-send"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif( \App\Classes\Helpers::instance()->checkPermissionsToApprove($etapa_doc, $document_id) )
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-5 mr-4">
                                                    <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">REJEITAR <i class="fa fa-remove"></i></button>
                                                </div>
                                                <div class="col-md-5">    
                                                    {{ Form::open(['route' => 'documentacao.approval-document', 'method' => 'POST']) }}
                                                        {{ Form::hidden('documento_id', $document_id) }}
                                                        {{ Form::hidden('etapa_doc', $etapa_doc) }}
                                                        {!! Form::button('APROVAR <i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Campos do documento e o editor -->
                                {!! Form::open(['route' => 'documentacao.save-edited-document', 'method' => 'POST', 'id' => 'form-edit-document', 'enctype' => 'multipart/form-data']) !!}
                                    {{ csrf_field() }}

                                    {!! Form::hidden('document_id', $document_id) !!}
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 small">
                                                <div class="form-group">
                                                    <div class="col-md-12 control-label font-bold">
                                                        {!! Form::label('tituloDocumento', 'TÍTULO DO DOCUMENTO:') !!}
                                                    </div>
                                                    <div class="col-md-12">
                                                        {!! Form::text('tituloDocumento', $nome, ['class' => 'form-control ', 'readonly']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 small">
                                                <div class="form-group">
                                                    <div class="col-md-12 control-label font-bold">
                                                        {!! Form::label('codigoDocumento', 'CÓDIGO DO DOCUMENTO:') !!}
                                                    </div>
                                                    <div class="col-md-12">
                                                        {!! Form::text('codigoDocumento', $codigo, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3 small">
                                                <div class="form-group">
                                                    <div class="col-md-12 control-label font-bold" style="margin-bottom:10px;">
                                                        FORMULÁRIOS: 
                                                    </div>
                                                    <div class="col-md-12">
                                                        <select multiple name="formulariosAtreladosDocs[]" data-forms="{{ $formsDoc }}" class="form-control select2-vinculos">
                                                            @foreach($formularios as $key => $form)
                                                                <option value="{{ $key }}" >{{ $form }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 small">
                                                <div class="form-group">
                                                    <div class="control-label font-bold text-uppercase text-center">
                                                        Pré-visualização de Documento<br>
                                                        <div class="text-center">   
                                                            <br>
                                                            <a href="{{ asset('plugins/onlyoffice-php/doceditor.php?fileID=').$docPath.'&type=embedded' }}" class="btn btn-success"  target="_blank">
                                                                Visualizar    
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>


                                    <!-- Editor -->
                                    <div class="container" >
                                        
                                        <iframe width="100%" id="speed-onlyoffice-editor" src="{{ asset('plugins/onlyoffice-php/doceditor.php?&user=&fileID=').$docPath.'&d='.(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE).'&p='.(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) }}"> </iframe>

                                    </div>
                                    <!-- End Editor -->
                                        
                                    
                                    
                                    <!-- Se o documento ainda não estiver finalizado, pode inserir observações | Qualidade e Elaborador sempre podem adicionar anexos -->
                                    <div class="row mt-4">
                                        @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                            </div>
                                        @endif
                                        <div class="col-md-3">    
                                            <button type="button" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-save-obs">NOVA OBSERVAÇÃO</button>
                                        </div>
                                        <div class="col-md-4">    
                                            <button type="button" class="btn btn-lg btn-rounded btn-primary ml-3" data-toggle="modal" data-target="#modal-view-obs">VISUALIZAR OBSERVAÇÕES</button>
                                        </div>
                                        <div class="col-md-3 ">
                                            <input type="button" id="btn-save-document" class="btn btn-lg btn-success" value="Salvar Alterações">
                                        </div>
                                    </div>
                                {!! Form::close() !!}

                            @elseif( $etapa_doc == Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM && ($elaborador_id == Auth::user()->id || Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) )

                                <div class="row">
                                    <div class="col-md-3" style="border-right: 1px solid black;">
                                        <div class="control-label font-bold text-center">
                                            <h3>Pré-visualização do Documento</h3>
                                            <div class="text-center">   
                                                <br>
                                                <a href="{{ asset('plugins/onlyoffice-php/doceditor.php?fileID=').$docPath.'&type=embedded' }}" class="btn btn-lg btn-success" target="_blank"> Visualizar </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        {!! Form::open(['route' => 'documentacao.salva-lista-presenca', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                            {{ csrf_field() }}

                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title"> Upload de lista de presença </h4>
                                                    <label for="input-file-now">Por favor, anexe a lista de presença do documento <b>{{ $nome }}</b> .</label>
                                                    {!! Form::hidden('documento_id', $document_id) !!}
                                                    {!! Form::hidden('nome_lista', "Lista Presença - " . $nome) !!}
                                                    
                                                    {!! Form::file('doc_uploaded', ['class' => 'dropify', 'id' => 'input-file-now', 'data-allowed-file-extensions'=>'pdf doc docx xlsx xls']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-offset-2 col-md-3 pull-right">
                                                    {!! Form::submit('Salvar Lista', ['class' => 'btn btn-lg btn-success', 'id' => 'btn-save-document']) !!}
                                                </div>
                                            </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>


                                <!-- Se o documento ainda não estiver finalizado, pode inserir observações | Qualidade e Elaborador sempre podem adicionar anexos -->
                                <div class="row mt-4">
                                    @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                        </div>
                                    @endif
                                    <div class="col-md-3">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-save-obs">NOVA OBSERVAÇÃO</button>
                                    </div>
                                    <div class="col-md-4">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary ml-3" data-toggle="modal" data-target="#modal-view-obs">VISUALIZAR OBSERVAÇÕES</button>
                                    </div>
                                    <div class="col-md-3 ">
                                    </div>
                                </div>

                            @elseif( $etapa_doc == Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM && ($elaborador_id == Auth::user()->id || Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) )
                            
                                {{ Form::open(['route' => 'documentacao.resend-list', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row text-center">
                                                @if( isset($justificativa) && $justificativa != "")
                                                    <div class="col-md-8">
                                                        <div class="ribbon-wrapper card ">
                                                            <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE REJEIÇÃO DA LISTA</div> 
                                                            <p class="ribbon-content"> {{ $justificativa }} </p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-4 align-middle">    
                                                    {{ Form::hidden('documento_id', $document_id) }}
                                                    {{ Form::hidden('etapa_doc', $etapa_doc) }}
                                                    {!! Form::button('REENVIAR LISTA <i class="fa fa-send"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h4 class="card-title"> Substituição da lista de presença </h4>
                                            <label for="input-file-now">Por favor, anexe a lista de presença <i>corrigida</i> do documento <b>{{ $nome }}</b> .</label>
                                            {!! Form::hidden('nome_lista', "Lista Presença - " . $nome) !!}                                        
                                            {!! Form::hidden('extensao', $extensao) !!}                                        
                                            {!! Form::file('doc_uploaded', ['class' => 'dropify', 'id' => 'input-file-now', 'data-allowed-file-extensions'=>'pdf doc docx xlsx xls', 'required'=>'required']) !!}
                                        </div>
                                    </div>
                                {{ Form::close() }}



                                <!-- Se o documento ainda não estiver finalizado, pode inserir observações | Qualidade e Elaborador sempre podem adicionar anexos -->
                                <div class="row mt-4">
                                    @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                        </div>
                                    @endif
                                    <div class="col-md-3">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-save-obs">NOVA OBSERVAÇÃO</button>
                                    </div>
                                    <div class="col-md-4">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary ml-3" data-toggle="modal" data-target="#modal-view-obs">VISUALIZAR OBSERVAÇÕES</button>
                                    </div>
                                    <div class="col-md-3 ">
                                    </div>
                                </div>



                                <div class="col-md-12 mb-4">
                                    <hr>
                                    <span class="row mt-2 mb-2">
                                        <h3>Abaixo você pode visualizar a <span class="text-info">Lista Presença - {{$nome}}</span> que foi rejeitada:</h3>
                                    </span>
                                </div>

                                <div class="row">
                                    <iframe src="{{ asset('plugins/onlyoffice-php/doceditor.php?type=embedded&folder=lists&user=&fileID=').$filePath }}" style="width:100%; height:500px;" frameborder="0"></iframe>
                                </div>

                            @elseif( $etapa_doc == Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM && (Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO || Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) )
                                
                                @if(Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO)
                                    <div class="row mb-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-5 mr-4">
                                                    <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#modal-reject-list">REJEITAR <i class="fa fa-remove"></i></button>
                                                </div>
                                                <div class="col-md-5">    
                                                    {{ Form::open(['route' => 'documentacao.approval-document', 'method' => 'POST']) }}
                                                        {{ Form::hidden('documento_id', $document_id) }}
                                                        {{ Form::hidden('etapa_doc', $etapa_doc) }}
                                                        {!! Form::button('APROVAR <i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 mb-4">
                                    <hr>
                                </div>

                                <div class="row">
                                    <!-- <iframe src="https://docs.google.com/viewer?url={{ rawurlencode($filePath) }}&embedded=true&chrome=false&dov=1" style="width:100%; height:500px;" frameborder="0"></iframe> -->
                                    <iframe src="{{ asset('plugins/onlyoffice-php/doceditor.php?type=embedded&folder=lists&user=&fileID=').$filePath }}" style="width:100%; height:500px;" frameborder="0"></iframe>
                                </div>


                                <!-- Se o documento ainda não estiver finalizado, pode inserir observações | Qualidade e Elaborador sempre podem adicionar anexos -->
                                <div class="row mt-4">
                                    @if( Auth::user()->id == $elaborador_id  ||  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-lg btn-rounded btn-info" data-toggle="modal" data-target="#modal-anexos">ANEXOS</button>
                                        </div>
                                    @endif
                                    <div class="col-md-3">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary" data-toggle="modal" data-target="#modal-save-obs">NOVA OBSERVAÇÃO</button>
                                    </div>
                                    <div class="col-md-4">    
                                        <button type="button" class="btn btn-lg btn-rounded btn-primary ml-3" data-toggle="modal" data-target="#modal-view-obs">VISUALIZAR OBSERVAÇÕES</button>
                                    </div>
                                    <div class="col-md-3 ">
                                    </div>
                                </div>


                            @endif
                        
                        @endif

                    </div>
                </div>

            </div>
            <!-- End Page Content -->



            <!-- modal justificativa reprovação do documento -->
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Rejeitar Documento</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {{ Form::open(['route' => 'documentacao.reject-document', 'method' => 'POST']) }}
                            {{ Form::hidden('documento_id', $document_id) }}
                            {{ Form::hidden('etapa_doc', $etapa_doc) }}
                            <div class="modal-body"> 
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            {!! Form::label('justificativaReprovacaoDoc', 'JUSTIFICATIVA:') !!}
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::textarea('justificativaReprovacaoDoc', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal justificativa reprovação do documento -->

            <!-- modal justificativa reprovação da lista de presença -->
            <div class="modal fade" id="modal-reject-list" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Rejeitar Lista de Presença</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {{ Form::open(['route' => 'documentacao.reject-document', 'method' => 'POST']) }}
                            {{ Form::hidden('documento_id', $document_id) }}
                            {{ Form::hidden('etapa_doc', $etapa_doc) }}
                            <div class="modal-body"> 
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            {!! Form::label('justificativaReprovacaoLista', 'JUSTIFICATIVA:') !!}
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::textarea('justificativaReprovacaoLista', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal justificativa reprovação da lista de presença -->

            <!-- modal para salvar observação no documento -->
            <div class="modal fade" id="modal-save-obs" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Salvar Observação</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        
                        {{ Form::hidden('documento_id', $document_id, ['id' => 'document_id']) }}
                        <div class="modal-body"> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 control-label font-bold">
                                        {!! Form::label('obsDocument', 'OBSERVAÇÃO:') !!}
                                    </div>
                                    <div class="col-md-12">
                                        {!! Form::textarea('obsDocument', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'obsDocument']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                            <button type="button" id="btn-save-obs" class="btn btn-success waves-effect">Gravar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal para salvar observação no documento -->

            <!-- modal para visualizar as observações do documento -->
            <div class="modal fade" id="modal-view-obs" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Observações do documento: <b>{{ $nome }}</b> </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        
                        <div class="modal-body"> 
                            <div class="row">
                                
                                <div class="chat-box justify-content-center text-center" style="width: 100%;">

                                    <!-- Listagem de Observações -->
                                    <ul class="chat-list container-fluid" id="obs-list" style="width: 100%;">
                                        
                                    </ul>
                                    
                                </div>  

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal para visualizar as observações do documento -->



            <!-- modal justificativa rejeição da requisição de revisão do documento -->
            <div class="modal fade" id="reject-request-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Rejeitar requisição de revisão</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {{ Form::open(['route' => 'documentacao.decides-on-review-request', 'method' => 'POST']) }}
                            {{ Form::hidden('documento_id', $document_id) }}
                            {{ Form::hidden('decisao', 'rejeitar') }}
                            <div class="modal-body"> 
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            {!! Form::label('justificativaReprovacaoDaRequisicao', 'JUSTIFICATIVA:') !!}
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::textarea('justificativaReprovacaoDaRequisicao', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal justificativa rejeição da requisição de revisão do documento -->


            <!-- Modal de confirmação - deseja mesmo aprovar a solicitação de revisão neste documento -->
            <div class="modal fade bs-example-modal-sm" id="approves-request-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Deseja aprovar a solicitação e iniciar o <i>workflow</i> de revisão do documento ? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'documentacao.decides-on-review-request', 'method' => 'POST']) }}
                                {{ Form::hidden('documento_id', $document_id) }}
                                {{ Form::hidden('decisao', 'aprovar') }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo aprovar a solicitação de revisão neste documento -->




            <!-- Modal de confirmação - deseja mesmo cancelar a revisão do documento -->
            <div class="modal fade bs-example-modal-sm" id="confirm-cancel-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Cancelar revisão</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {{ Form::open(['route' => 'documentacao.cancel-review', 'method' => 'POST']) }}
                            {{ Form::hidden('documento_id', $document_id) }}
                            <div class="modal-body"> 
                                Deseja, realmente, reverter todas alterações realizadas e cancelar a revisão deste documento ?
                                <div class="row mt-3">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            {!! Form::label('justificativaCancelamentoRevisao', 'JUSTIFICATIVA:') !!}
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::textarea('justificativaCancelamentoRevisao', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo cancelar a revisão do documento -->
            
            
            
            <!-- Modal de Anexos -->
            <div id="modal-anexos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow-y: auto">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="mySmallModalLabel">Anexos - <b>{{ $nome }}</b> </h4>
                            <button type="button" id="btn-lista-anexos" class="btn btn-primary btn-circle" data-toggle="collapse" data-target="#lista-anexos-cadastrados" aria-expanded="false" aria-controls="lista-anexos-cadastrados" role="tab" style="cursor: pointer"><i class="fa fa-list" data-toggle="tooltip" data-original-title="Listar Anexos Cadastrados"  aria-hidden="true"></i></button>
                        </div>
                        
                        <div class="modal-body"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        Ações envolvendo anexos podem demorar um pouco. Após executar alguma ação, por favor, aguarde a mensagem de sucesso!
                                    </h6>
                                </div>
                                <div class="col-md-12">
                                    <div class="collapse" id="lista-anexos-cadastrados" role="tabpanel">
                                        <h3>Listagem de Anexos do Documento</h3>
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-nowrap text-center">Título do Anexo</th>
                                                        <th class="text-nowrap text-center">Data de Inserção</th>
                                                        <th class="text-nowrap text-center">Remover</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="attachment-table-body">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr style="border-top: 2px solid darkgray">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"> Upload de anexo </h4>
                                            {!! Form::open(['route' => 'ajax.anexos.save', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-save-attachment']) !!}
                                                <label for="input-file-now">Por favor, selecione o arquivo que você deseja anexar ao documento atual.</label>
                                                {!! Form::file('anexo_escolhido', ['class' => 'dropify', 'id' => 'anexo_escolhido', 'data-allowed-file-extensions'=>'pdf xlsx xls']) !!}

                                                <div class="col-md-12 mt-3">
                                                    <div class="col-md-9 pull-left">
                                                        {!! Form::hidden('document_id', $document_id) !!}
                                                        {!! Form::text('nome_anexo', null, ['class' => 'form-control', 'id' => 'nome_anexo', 'required' => 'required', 'placeholder' => 'Nome do Anexo']) !!} 
                                                    </div>
                                                    <div class="col-md-3 pull-right">
                                                        {!! Form::submit('Salvar Anexo', ['class' => 'btn btn-lg btn-success', 'id' => 'btn-save-attachment']) !!}
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- /.Modal de Anexos -->


             <!-- Modal de confirmação - deseja mesmo excluir o anexo -->
             <div class="modal fade" id="confirm-delete-attachment" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Deseja realmente excluir o anexo selecionado ? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'ajax.anexos.removeAttachment', 'method' => 'POST', 'id' => 'delete-attachment']) }}
                                {{ Form::hidden('documento_id', $document_id) }}
                                {{ Form::hidden('anexo_id', null, ['id' => 'hidden_anexo_id_to_remove']) }}
                                <button type="submit" id="btn-confirm-delete-attachment" class="btn btn-success waves-effect"> Sim </button>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo excluir o anexo -->


        </div>
    </div>
    

    <!-- Formulário para visualizar o formulário ( dafuk ?????? )  -->
    {{ Form::open(['route' => 'formularios.view-formulario', 'target'=>'_blank', 'id'=>'form-view-formulario', 'method' => 'POST']) }}
        {{ Form::hidden('action', 'view') }}
    {{ Form::close() }}

@endsection

@section('footer')

<script>

    var etapaDocumento = "{{$etapa_doc}}";
    var etapaMinina = "{{Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM}}";
    var etapaMaxima = "{{Constants::$ETAPA_WORKFLOW_APROVADOR_NUM}}";
    
    if(etapaDocumento >= etapaMinina && etapaDocumento <= etapaMaxima) {

        var forms = JSON.parse($(".select2-vinculos").attr('data-forms'));
        var select = $(".select2-vinculos").select2({
            templateSelection: function (d) { 
                return $('<a href="#" onclick="viewFormulario('+d.id+')" ><b>'+d.text+'</b></a>'); 
            },
        });
        
        select.val(forms);
        select.trigger('change');   
    }

    function viewFormulario(id){
        $("#form-view-formulario").append("<input type='hidden' name='formulario_id' value="+id+" >");
        $("#form-view-formulario").submit();
    }   


    $("#btn-save-document").click(function(){
        $("#form-edit-document").submit();
    });

    // Quando clicar para salvar observação, invoca Ajax
    $("#btn-save-obs").click(function(){
        var document_id = "{{$document_id}}";
        var obsDoc = $("#obsDocument").val();
        
        if(obsDoc == null || obsDoc == '') {
            showToast('Erro!', 'Por favor, preencha o campo de observação.', 'warning');
        } else {
            var obj = {'document_id': document_id, 'obs': obsDoc};        
            ajaxMethod('POST', " {{ URL::route('ajax.documentos.salvaObservacao') }} ", obj).then(function(result) {
                var data = result.response;
                
                $('#modal-save-obs').modal('toggle');
                showToast('Sucesso!', 'A observação foi gravada com sucesso.', 'success');
            }, function(err) {
            });
        }
    });

    // Toda vez que o modal para gravar observação for fechado, limpa o textarea
    $('#modal-save-obs').on('hidden.bs.modal', function (e) {
        $("#obsDocument").val('');
    })

    // Toda vez que o modal para visualizar observações for aberto, invoca Ajax para listar todas observações
    $('#modal-view-obs').on('show.bs.modal', function (e) {
        var document_id = "{{$document_id}}";
        
        var obj = {'document_id': document_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.documentos.getObservacoes') }} ", obj).then(function(result) {
            $("#obs-list").empty();
            var count = 0;
            var data = result.response;
            
            data.forEach(function(key) {
                var li_f = "";
                var event = new Date(key.created_at);
                var year = event.getFullYear(), month = event.getMonth()+1, date1 = event.getDate(), hour = event.getHours(), minutes = event.getMinutes();

                var dateF = hour +":"+ minutes +" "+ date1 +"/"+ month +"/" + year;
                if(count % 2 == 0) {
                    li_f = '<li><div class="chat-content"><h5>' + key.nome_usuario_responsavel + '</h5><div class="box bg-light-info">' + key.observacao + '</div></div><div class="chat-time">' + dateF + '</div></li>' ;
                } else {
                    li_f = '<li class="odd"><div class="chat-content"><h5>' + key.nome_usuario_responsavel + '</h5><div class="box bg-light-inverse">' + key.observacao + '</div><br/></div><div class="chat-time">' + dateF + '</div></li>'; 
                }

                $("#obs-list").append(li_f);
                count++;
            });
        }, function(err) {
        });
    })

    // Quando o solicitante da revisão do documento aceitar a justificativa de rejeição da mesma
    $("#ok-justify-reject").click(function() {
        var document_id = "{{$document_id}}";
        
        var obj = {'document_id': document_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.documentos.okJustifyRejectRequest') }} ", obj).then(function(result) {
            $("#justification-reject-review-div").hide(1000);
        }, function(err) {
        });
    });

    // Quando o solicitante da revisão do documento aceitar a justificativa de cancelamento da mesma
    $("#ok-justify-cancel").click(function() {
        var document_id = "{{$document_id}}";
        
        var obj = {'document_id': document_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.documentos.okJustifyCancelRequest') }} ", obj).then(function(result) {
            $("#justification-cancel-review-div").hide(1000);
        }, function(err) {
        });
    });

    // Função para salvar anexo
    $("#form-save-attachment").submit(function(e){
        e.preventDefault();
        if( $("#anexo_escolhido").val() == null  ||  $("#anexo_escolhido").val() == "" ) {
            showToast('Opa!', 'Você precisa escolher um arquivo.', 'error');
            return;
        }        

        var form = $(this);
        var formData = new FormData($(this)[0]);
        var url = form.attr('action');
        $.ajax({  
             type: "POST",  
             url: url,  
             data: formData,
             async: false,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data) {
                showToast('Sucesso!', 'O anexo foi salvo.', 'success');
                $("#modal-anexos").modal('toggle');
                $("#btn-lista-anexos").trigger('click');
             }
        }); 
    });

    // Coloca o nome original do arquivo no campo do nome
    $(document).on("change", "#anexo_escolhido", function(e){
        var file = $("#anexo_escolhido")[0].files[0];
        if(file) {
            var completo = file.name;
            var sem_extensao = completo.split('.')[0];
            $("#nome_anexo").val(sem_extensao);
        }  
    });

    // Toda vez que o modal de anexos for fechado, limpa os dois valores do form
    $('#modal-anexos').on('hidden.bs.modal', function (e) {
        $("#anexo_escolhido").val('');
        $(".dropify-clear").trigger('click');
        $("#nome_anexo").val('');
    })

    // Toda vez que a listagem de anexos do documento for aberta
    $('#btn-lista-anexos').click(function () {
        var document_id = "{{$document_id}}";
        
        var obj = {'document_id': document_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.anexos.getAnexos') }} ", obj).then(function(result) {
            $("#attachment-table-body").empty();
            var data = result.response;
            
            data.forEach(function(key) {
                var event = new Date(key.created_at);
                var year = event.getFullYear(), month = event.getMonth()+1, date1 = event.getDate(), hour = event.getHours(), minutes = event.getMinutes();
                var dateF = hour +":"+ minutes +"  "+ date1 +"/"+ month +"/" + year;

                var tr = '<tr>';
                tr += '<td class="text-nowrap text-center"><a href="{{ asset("plugins/onlyoffice-php/doceditor.php?type=embedded&folder=anexos&fileID=") }}'+key.encodeFilePath+' " target="_blank">'+ key.nome +'</a></td><td class="text-nowrap text-center">'+ dateF +'</td><td class="text-nowrap text-center"><button type="button" id="btn-delete-attachment-modal" class="btn btn-rounded btn-danger" data-anexo-id="'+ key.id +'"> <i class="fa fa-close"></i> </button></td>'; 
                tr += '</tr>';
                $("#attachment-table-body").append(tr);
            });
        }, function(err) {
        });
    })

    // Quando o botão para remover anexo é clicado, abre modal de confirmação
    $(document).on("click", "#btn-delete-attachment-modal", function(){
        var anexo_id = $(this).data("anexo-id");
        $("#hidden_anexo_id_to_remove").val(anexo_id);

        $("#confirm-delete-attachment").modal({ backdrop: false, keyboard: false});
    });

    // Se o usuário confirmar que deseja, realmente, excluir o anexo, invoca Ajax
    $("#delete-attachment").submit(function(e){
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        ajaxMethod('POST', url, form.serialize()).then(function(result) {
            showToast('Sucesso!', 'O anexo foi removido.', 'success');
            $("#confirm-delete-attachment").modal('toggle');
            $("#btn-lista-anexos").trigger('click');
        }, function(err) {
        });
    });

</script>

 @if($resp)
    <script src="{{ asset('js/utils-speed.js') }}"></script>    
    <script>
        showToast("{{$resp['title']}}", "{{$resp['msg']}}", "{{$resp['status']}}");
    </script>
@endif


@endsection