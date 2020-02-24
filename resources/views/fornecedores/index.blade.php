@extends('layouts.app')

@section('content')
    
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Fornecedores</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Fornecedores</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10  btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
                    </div>
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

                            @if(Session::has('message'))
                                <div class="alert alert-{{str_before(Session::get('style'), '|')}}"> <i class="mdi mdi-{{str_after(Session::get('style'), '|')}}"></i> {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                            @elseif(Session::has('removed-doc-success'))
                                <div class="alert alert-success"> <i class="mdi mdi-check-circle"></i> {{ Session::get('removed-doc-success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>

                                @php
                                    Session::forget('removed-doc-success');
                                @endphp
                            @endif

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="col-md-6 margin-top-1percent">
                                        <div class="col-md-12">
                                            <a href="{{route('fornecedores.novo')}}" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">Novo Fornecedor </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-2 margin-top-1percent">
                                <div class="table-responsive m-t-40">
                                    <table id="tabela-fornecedores" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Ações</th>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Nome</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fornecedores as $fornecedor)
                                                <tr>
                                                    <td class="text-center text-nowrap">
                                                        <a href="{{ route('fornecedores.editar', ['id' => $fornecedor->id]) }}"> <i class="fa fa-pencil text-success" data-toggle="tooltip" data-original-title="Editar Informações"></i> </a>

                                                        @if (Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE)

                                                            @if ($fornecedor->inativo)
                                                                <a href="javascript:void(0)" class="fornecedor-ativo-inativo ml-3" onclick="updateFornecedor(this)" data-id="{{ $fornecedor->id }}"> <i class="fa fa-power-off text-success" data-toggle="tooltip" data-original-title="Ativar Fornecedor"></i> </a> 
                                                            @else
                                                                <a href="javascript:void(0)" class="fornecedor-ativo-inativo ml-3" onclick="updateFornecedor(this)" data-id="{{ $fornecedor->id }}"> <i class="fa fa-power-off text-danger" data-toggle="tooltip"  data-original-title="Inativar Fornecedor"></i> </a> 
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center text-nowrap">{{$fornecedor->id}}</td>
                                                    <td class="text-center text-nowrap">{{$fornecedor->nome}}</td>
                                                    <td class="text-center text-nowrap">{{$fornecedor->inativo ? 'Inativo' : 'Ativo'}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal fade" id="fornecedor-ativo-inativo-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-body"> 
                                            Tem certeza que deseja executar essa ação? 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>
                
                                            {{ Form::open(['route' => 'fornecedores.ativarInativar', 'method' => 'POST']) }}
                                                {{ Form::hidden('fornecedor_id', '', ['id' => 'fornecedor_id']) }}
                                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                                            {!! Form::close() !!}
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
            

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection



@section('footer')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $('#tabela-fornecedores').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel',  text: 'Excel' },
                { extend: 'pdf',    text: 'PDF' },
                { extend: 'print',  text: 'Imprimir' }
            ]
        });


        
        function updateFornecedor(element) {
            $("#fornecedor_id").val($(element).attr('data-id'));
            $("#fornecedor-ativo-inativo-modal").modal('show');
        }
    </script>

@endsection