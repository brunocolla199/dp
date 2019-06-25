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
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Documentação</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Relatório Estatístico</li>
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
                            
                            <div class="alert alert-info text-center">Por favor, faça a busca para que possamos encontrar os resultados que deseja!</div>

                            @if($errors->any())
                                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                            @endif
                            
                            {{-- Formulário de Filtro: define o período e os tipos de documentos selecionados --}}
                            {!! Form::open(['route' => 'documentacao.make-statical-report', 'method' => 'POST', 'class' => 'form-inline m-t-20']) !!}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            <h5 class="box-title">Período da Busca</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" style="width: 100%" required/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12 control-label font-bold">
                                            <h5 class="box-title">Tipo de Documento</h5>
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::select('tipo_documento',  array('todos' => '-- Todos --')  + $tipoDocumentos, null, ['class' => 'form-control  custom-select', 'style' => 'width: 100%', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-block btn-success m-t-30"> <i class="mdi mdi-search"></i> Buscar</button>
                                </div>
                            {!! Form::close() !!}

                            {{-- Linha Inicial: TOTALIZADORES --}}
                            <div class="row m-t-20">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"><span class="font-weight-bold">Revisados:</span> {{ $periodo }} </h4>
                                            <div class="text-center m-t-40">
                                                <input data-plugin="knob" data-readOnly=true data-width="250" data-height="250" data-min="-100" data-fgColor="#26c6da" data-displayPrevious=true data-angleOffset=-125 data-angleArc=250 value="{{ $totalPendentesRevisao }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"><span class="font-weight-bold">Pendentes Revisão:</span> {{ $periodo }} </h4>
                                            <div class="text-center m-t-40">
                                                <input data-plugin="knob" data-readOnly=true data-width="250" data-height="250" data-min="-100" data-fgColor="#ffbc34" data-displayPrevious=true data-angleOffset=-125 data-angleArc=250 value="{{ $totalRevisados }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Linha Intermediária: GRÁFICO POR SETOR --}}
                            <div class="row m-t-20">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Documentos por Setor</h4>
                                            <div id="morris-bar-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Linha Final: lista de documentos por setores --}}
                            <div id="sectorsList" class="accordion" role="tablist" aria-multiselectable="true">
                                @forelse ($listaDocumentosPorSetor as $sector)
                                
                                    <div class="card">
                                        <div class="card-header cursor-pointer-on" role="tab" id="headingOne" data-toggle="collapse" data-parent="#sectorsList" href="#{{ $sector['identifier'] }}" aria-expanded="true" aria-controls="{{ $sector['identifier'] }}">
                                            <h4 class="mb-0 text-info">{{ $sector['sectorName'] }}</h4>
                                        </div>
                                        <div id="{{ $sector['identifier'] }}" class="collapse {{ $loop->first ? 'show' : ''}}" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>Revisados</h5>
                                                        <ul class="list-group">
                                                            @forelse ($sector['revised'] as $docRevised)
                                                                
                                                                <li class="list-group-item"><span class="font-weight-bold">{{ $docRevised->codigo }}</span>: {{ \Illuminate\Support\Str::limit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docRevised->nome)[0], 50) }}</li>
                                                            @empty
                                                                
                                                                <h6 class="text-center">Não existe nenhum documento revisado no setor {{ $sector['sectorName'] }}!</h6>
                                                            @endforelse 
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Pendentes Revisão</h5>
                                                        <ul class="list-group">
                                                            @forelse ($sector['expired'] as $docExpired)
                                                                                                                            
                                                                <li class="list-group-item"><span class="font-weight-bold">{{ $docExpired->codigo }}</span>: {{ \Illuminate\Support\Str::limit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docExpired->nome)[0], 50) }}</li>
                                                            @empty

                                                                <h6 class="text-center">Não existe nenhum documento vencido no setor {{ $sector['sectorName'] }}!</h6>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    
                                    <h5 class="text-center">Não existe nenhum documento vencido ou revisado!</h5>
                                @endforelse
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


@section('footer')

    {{-- DateRangePicker.js --}}
    <link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-success',
            cancelClass: 'btn-inverse',
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Selecionar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Custom",
                "daysOfWeek": [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb" ],
                "monthNames": [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
                "firstDay": 1
            }
        });
    </script>


    {{-- jQuery KnobChart --}}
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <script>
        $(function() {
            $('[data-plugin="knob"]').knob();
        });
    </script>


    {{-- Morris JavaScript --}}
    <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>
    <script>
        let docsBySector = @json($documentosPorSetor);
    </script>
    <script src="{{ asset('js/morris-data.js') }}"></script>

@endsection
