@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    @if (session('padrao_sucesso'))
		<input type="hidden" name="status" id="status" value="padrao_sucesso">
    @endif

    <script>
        $(document).ready(function(){
            // Verifica se acabou de gravar uma nova solicitação
            var status = $("#status").val();
            if(status == "padrao_sucesso") {
                $.toast({
                    heading: 'Sucesso!',
                    text: 'O número padrão para geração do código do documento foi, atualizado.',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            }
        });
    </script>

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
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Configurações</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Configurações</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#setores" role="tab"><h3 class="hidden-xs-down">SETORES</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#novoSetor" role="tab"><h3 class="hidden-xs-down">NOVO SETOR</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#padroes" role="tab"><h3 class="hidden-xs-down">PADRÕES</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- 
                                    /* TAB - Setores */ 
                                -->
                                <div class="tab-pane active" id="setores" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-md-12">
                                            

                                            <div class="row mt-5 margin-top-1percent">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome do Setor</th>
                                                                <th>Tipo do Setor</th>
                                                                <th>Descrição</th>
                                                                <th>Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($setores as $setor)
                                                                <tr>
                                                                    <td><a href="javascript:void(0)">{{ $setor->nome }}</a></td> 
                                                                    <td>
                                                                        @if( // $setor->tipo_setor_id == Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO  )
                                                                            <i class="fa fa-gavel"></i>
                                                                        @elseif(  $setor->tipo_setor_id == Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO  )
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        @else
                                                                            <i class="fa fa-sitemap"></i>
                                                                        @endif

                                                                        {{ $setor->nome_tipo }}
                                                                    </td>
                                                                    <td>{{ $setor->descricao }}</td>
                                                                    <td class="text-nowrap">
                                                                        <a href="#" data-toggle="tooltip" data-original-title="Editar"> <i data-toggle="modal" data-target="#edit-group-modal" class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                                        <a href="#" class="sa-warning" data-toggle="tooltip" data-original-title="Excluir"> <i class="fa fa-close text-danger"></i> </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                <!-- 
                                    /* TAB - Novo Setor */ 
                                -->
                                <div class="tab-pane  p-20" id="novoSetor" role="tabpanel">
                                    <div class="col-md-12">
                                          

                                        <div class="row mt-5 margin-top-1percent">
                                           <h3><i class="fa fa-spin fa-cog"></i> Making... <br></h3>
                                           
                                           <div class="row">
                                                <h4>aqui deverá ter:</h4>
                                                <ul>
                                                    <li> 1 campo para nome do setor </li>
                                                    <li>1 select para o tipo
                                                        <ul><li> se for setor normal da empresa, habilita campo para que seja informada a sigla do setor </li></ul>
                                                    </li> 
                                                    <li> decidir se é mais interessante deixar a funcionalidade de vincular usuários a esse setor aqui ou na edição de setor</li>
                                                </ul>
                                           </div>
                                        </div>
                                    </div> 
                                </div>


                                <!-- 
                                    /* TAB - Padrões */ 
                                -->
                                <div class="tab-pane  p-20" id="padroes" role="tabpanel">
                                    <div class="col-md-12"> 
                                           
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="col-md-12 mb-4">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <span><b>Exemplos de valores aceitos:</b></span>
                                                                <ul>
                                                                    <li>0       <span class="text-muted">- Código gerado será [1, 2, 3....]</span></li>
                                                                    <li>000     <span class="text-muted">- Código gerado será [001, 002, 003....]</span></li>
                                                                    <li>000.    <span class="text-muted">- Código gerado será [001.01, 002.01, 003.01....]</span></li>
                                                                </ul>
                                                                <small><b>Lembre-se:</b> são aceitos apenas 4 dígitos, sendo que o último deve ser um ponto (.)!</small>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    {!! Form::open(['route' => 'configuracoes.save.number-default', 'class' => 'form-horizontal']) !!}
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('numeroPadrao', 'PADRÃO PARA NÚMERO DO CÓDIGO DE DOCUMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('numeroPadrao', $numeroPadraoParaCodigo, ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-offset-8 pull-right col-md-4 mt-4">
                                                            <button type="submit" class="btn btn-block btn-outline-success">Salvar</button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                </div>
                                          

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


            <!-- modal para editar grupo -->
            <div id="edit-group-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Modal Content is Responsive</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal para editar grupo -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection