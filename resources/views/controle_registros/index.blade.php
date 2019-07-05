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
                    <h3 class="text-themecolor m-b-0 m-t-0">Controle de Registros</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Controle de Registros</li>
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
                            @endif

                            <div class="col-md-12">
                                <a href="{{ route('controle-registros.create') }}" class="btn waves-effect waves-light btn-lg btn-success pull-right mb-4">Criar Registro </a>
                            </div>

                            <div class="table-responsive m-t-40">
                                <table id="tabela-controle-registros" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-nowrap">Ações</th>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Responsável</th>
                                            <th class="text-center">Meio</th>
                                            <th class="text-center">Armazenamento</th>
                                            <th class="text-center">Proteção</th>
                                            <th class="text-center">Recuperação</th>
                                            <th class="text-center">Acesso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registros as $registro)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($registro->avulso)
                                                        <a href="{{ route('controle-registros.edit', ['registro' => $registro->id]) }}" class="mr-3"> <i class="fa fa-pencil text-info" data-toggle="tooltip" data-original-title="Editar Informações"></i> </a>
                                                    @endif

                                                    <a href="#" class="btn-remove" data-register-id="{{ $registro->id }}"> <i class="fa fa-trash text-danger" data-toggle="tooltip" data-original-title="Excluir"></i> </a>
                                                </td>
                                                <td class="text-center">{{ $registro->codigo }}</td>
                                                <td class="text-center">{{ $registro->titulo }}</td>
                                                <td class="text-center">{{ $registro->setor->nome }}</td>
                                                <td class="text-center">{{ $registro->meio_distribuicao }}</td>
                                                <td class="text-center">{{ $registro->local_armazenamento }}</td>
                                                <td class="text-center">{{ $registro->protecao }}</td>
                                                <td class="text-center">{{ $registro->recuperacao }}</td>
                                                <td class="text-center">{{ $registro->nivel_acesso }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>      
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

    <!-- This is data table -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    
    <!-- start - This is for export functionality only -->
    <script src="{{ asset('js/dataTables/dataTables-1.2.2.buttons.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.flash.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/jszip-2.5.0.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/pdfmake-0.1.18.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/vfs_fonts-0.1.18.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.html5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.print.min.js') }}"></script>
    <!-- end - This is for export functionality only -->    

    {{-- DataTable --}}
    <script>
        $(document).ready(function() {
            $('#tabela-controle-registros').DataTable({
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
        });
    </script>

    {{-- SweetAlert - Exclusão --}}
    <script>
        $('.btn-remove').click(function(){
            let registerID = $(this).data('register-id');
            let obj = {'register_id': registerID};

            swal({   
                title: "Você tem certeza?",   
                text: "Todos os dados deste registro serão perdidos!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Sim, eu tenho certeza!",   
                cancelButtonColor: "#DD6B55",   
                cancelButtonText: "Cancelar",   
                closeOnConfirm: false 
            }, function(){

                ajaxMethod('DELETE', " {{ URL::route('controle-registros.delete') }} ", obj).then(function(result) {                    
                    if(result.response === 'success') {
                        swalWithReload("Sucesso!", "O registro foi removido com sucesso.", "success");
                    } else {
                        swalWithReload("Ops!", "Tivemos um problema ao remover o registro. Por favor, contate o suporte!.", "error");
                    }
                }, function(err) {
                });
            });
        });
    </script>

@endsection