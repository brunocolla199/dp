@extends('layouts.app')

@section('content')

    <!-- O que fazer nestas situações? -->
    
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">



	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                
                <div class="col-md-9 col-9 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Visualização de Formulário Obsoleto</li>
                    </ol>
                </div>
                
                <?php $revisoes = \App\Classes\Helpers::instance()->getNameListAllFormRevisions($formulario_id); ?>
                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  count($revisoes) > 1)
                    <div class="col-3">
                        <button class="btn btn-lg btn-warning" id="btnRevisoesForm" type="button" data-toggle="collapse" data-target="#revisoesForm" aria-expanded="false" aria-controls="revisoesForm">Revisões Anteriores</button>
                    </div>
                @endif                

            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline-danger">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Este formulário está obsoleto</h4>
                        </div>
                    </div>
                </div>

                <!-- Card Principal -->
                <div class="col-12">
                    <div class="card">
                        <div class=" card-body">

                            <!-- Revisões do Formulário -->
                            @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  count($revisoes) > 1)
                                <div class="row">
                                    <div class="col col-centered">
                                        <div class="collapse multi-collapse" id="revisoesForm">
                                            <div class="card card-body text-center">

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 p-20">
                                                        <h3 class="card-title text-success">Revisões do formulário: <b>{{ $nome }}</b></h3>
                                                        <div class="list-group" id="reviews-list-div">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif        


                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloFormulario', $nome, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('codigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('codigoFormulario', $codigo, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="control-label font-bold text-center timeline-doc-title">
                                                Timeline do Formulário
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- <iframe src="https://docs.google.com/viewer?url={{ rawurlencode($filePath) }}&embedded=true&chrome=false&dov=1" style="width:100%; min-height:800px;" frameborder="0"></iframe> -->
                                    <iframe src="{{ asset('plugins/onlyoffice-php/doceditor.php?lang=pt&type=embedded&folder=formularios&fileID=').$filePath }}" style="width:100%; min-height:800px;" frameborder="0"></iframe>
                                </div>
                                    
                                <div class="col-md-4" style="font-size:14px; height: 800px; overflow-y: scroll;">
                                    <div class="form-group">
                                        
                                        <!-- INICIO TIMELINE FORMS -->
                                        <?php \Carbon\Carbon::setLocale('pt_BR') ?>
                                        
                                        <ul class="timeline">
                                            
                                        @foreach($historico as $key => $hist)
                                            <li class=" {{ $key%2 == 0 ? 'timeline-inverted' : '' }}">
                                                <div class="timeline-badge {{ ($loop->last && $hist->finalizado) ? 'icon-green' : 'success'}} "  >
                                                    <!-- <i class="mdi {{ ($hist->finalizado == 'true') ? 'mdi-check-circle-outline' : 'mdi-file-document' }}"></i>  ESSE TA CERTO, MAS PRECISA SALVAR A ETAPA-->
                                                    
                                                    @if ($loop->last && $hist->finalizado)
                                                        <i class="mdi mdi-check-circle-outline"></i>
                                                    @else
                                                        <i class="mdi mdi-file-document"></i>
                                                    @endif

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
                                                                                        
                                        <!-- END TIMELINE FORMS -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <br>
                                <div class="col-md-offset-2 col-md-3 pull-right">
                                    <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" onclick="history.back()">Voltar</button>
                                </div>
                            </div>

                        </div>

                        
                    </div>
                </div>

            </div>
            

        </div>
    </div>


@endsection

@section('footer')

<script>

    // Toda vez que a listagem de revicões do formulário for aberta
    $('#btnRevisoesForm').click(function () {
        var form_id = "{{$formulario_id}}";
        
        var obj = {'form_id': form_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.formularios.getFilesFormRevisions') }} ", obj).then(function(result) {
            $("#reviews-list-div").empty();
            var data = result.response;
            console.log(data);
            
            data.forEach(function(key) {
                var a = '<a href="';
                // a += 'https://docs.google.com/viewer?url='+ key.encodeFilePath +'&embedded=true&chrome=false&dov=1" class="list-group-item mt-3" target="_blank"> <span style="font-size: 150%">Revisão <b>' +key.revisao+ '</b></span>:  ' + key.nome; 
                a += '{{ asset("plugins/onlyoffice-php/doceditor.php?type=embedded&folder=formularios&fileID=") }}'+key.encodeFilePath+'" class="list-group-item mt-3" target="_blank"> <span style="font-size: 150%">Revisão <b>' +key.revisao+ '</b></span>:  ' + key.nome;
                a += '</a>';
                $("#reviews-list-div").append(a);
            });
        }, function(err) {
        });
    })

</script>

 @if($resp)
    <script src="{{ asset('js/utils-speed.js') }}"></script>    
    <script>
        showToast("{{$resp['title']}}", "{{$resp['msg']}}", "{{$resp['status']}}");
    </script>
@endif


@endsection