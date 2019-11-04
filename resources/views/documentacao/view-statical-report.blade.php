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
                    <button
                        class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10  btn-badge badge-top-right"
                        data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
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

                        <div class="alert alert-info text-center">Por favor, faça a busca para que possamos encontrar os
                            resultados que deseja!</div>

                        @if($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                        @endif

                        {{-- Formulário de Filtro: define o período e os tipos de documentos selecionados --}}
                        {!! Form::open(['route' => 'documentacao.make-statical-report', 'method' => 'POST', 'class' =>
                        'form-inline m-t-20']) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-12 control-label font-bold">
                                    <h5 class="box-title">Período da Busca</h5>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control input-daterange-datepicker" type="text" name="daterange"
                                        value="{{ $periodo }}" style="width: 100%" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-12 control-label font-bold">
                                    <h5 class="box-title">Tipo de Documento</h5>
                                </div>
                                <div class="col-md-12">
                                    {!! Form::select('tipo_documento', array('todos' => '-- Todos --') +
                                    $tipoDocumentos, null, ['class' => 'form-control custom-select', 'style' => 'width:
                                    100%', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-block btn-success m-t-30"> <i class="mdi mdi-search"></i>
                                Buscar</button>
                        </div>
                        {!! Form::close() !!}

                        {{-- Linha Inicial: TOTALIZADORES --}}
                        <div class="row m-t-20">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><span class="font-weight-bold">Revisados entre:</span>
                                            {{ $periodo }} </h4>
                                        <div class="text-center m-t-40">
                                            <label style="font-size:75px; color:#26c6da; ">{{$totalRevisados}}</label>
                                        </div>
                                        <h6><span class="font-weight-bold">{{ $totalRevisados }}</span> é a quantidade de documentos que foram <span class="font-weight-bold">revisados entre {{ $periodo }}</span>.</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><span class="font-weight-bold">Pendentes Revisão</h4>
                                        <div class="text-center m-t-40">
                                            <label style="font-size:75px; color:#ffbc34">{{$totalPendentesRevisao}}</label>
                                        </div>
                                        <h6><span class="font-weight-bold">{{ $totalPendentesRevisao }}</span> é a quantidade de documentos que <span class="font-weight-bold">possuem sua data de validade inferior a {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>.</h6>
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
                                        <div id="bar-chart" style="width:100%; height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Linha Final: lista de documentos por setores --}}
                        <div id="sectorsList" class="accordion" role="tablist" aria-multiselectable="true">
                            @forelse ($listaDocumentosPorSetor as $sector)
                            <div class="card">
                                <div class="card-header cursor-pointer-on" role="tab" id="headingOne"
                                    data-toggle="collapse" data-parent="#sectorsList"
                                    href="#{{ str_replace("&", "e" ,$sector['identifier']) }}" aria-expanded="true"
                                    aria-controls="{{ str_replace("&", "e" ,$sector['identifier']) }}">
                                    <h4 class="mb-0 text-info">{{ $sector['sectorName'] }}</h4>
                                </div>
                                <div id="{{ str_replace("&", "e" ,$sector['identifier']) }}" class="collapse {{ $loop->first ? 'show' : ''}}"
                                    role="tabpanel" aria-labelledby="headingOne">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Revisados</h5>
                                                <ul class="list-group">
                                                    @forelse ($sector['revised'] as $docRevised)
                                                    <li class="list-group-item">
                                                        <span class="font-weight-bold">{{ $docRevised->codigo }}</span>
                                                        ({{ count($docRevised->revisions) }}x):
                                                        {{ \Illuminate\Support\Str::limit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docRevised->nome)[0], 50) }}
                                                    </li>
                                                    @empty
                                                    <h6 class="text-center">Não existe nenhum documento revisado no
                                                        setor {{ $sector['sectorName'] }}!</h6>
                                                    @endforelse
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Pendentes Revisão</h5>
                                                <ul class="list-group">
                                                    @forelse ($sector['expired'] as $docExpired)
                                                    <li class="list-group-item">
                                                        <span class="font-weight-bold">{{ $docExpired->codigo }}</span>:
                                                        {{ \Illuminate\Support\Str::limit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docExpired->nome)[0], 50) }}
                                                    </li>
                                                    @empty
                                                    <h6 class="text-center">Não existe nenhum documento vencido no setor
                                                        {{ $sector['sectorName'] }}!</h6>
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

<script src="{{ asset('plugins/echarts/echarts-all.js') }}"></script>
<script>

    const chartist = @json($chartist);
    // ============================================================== 
    // Bar chart option
    // ============================================================== 
    var myChart = echarts.init(document.getElementById('bar-chart'));


    let markPointExpiredValues = [];
    $.each(chartist.expired, function (i, el) { 
        markPointExpiredValues[i] = {
            'value': el,
            'xAxis': i,
            'yAxis': el + 1,
            'symbolSize': 11,
        };
    });

    let markPointRevisedValues = [];
    $.each(chartist.revised, function (i, el) { 
        markPointRevisedValues[i] = {
            'value': el,
            'xAxis': i,
            'yAxis': el + 1,
            'symbolSize' : 11,
        };
    });

    // specify chart configuration item and data
    option = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data: ['Revisados', 'Pendentes'], 
        },
        toolbox: {
            show: true,
            feature: {
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        color: ["#26c6da", "#ffbc34"],
        calculable: true,
        xAxis: [
            {
                type: 'category',
                data: chartist.sectors, 
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name:'Revisados',
                type:'bar',
                data: chartist.revised,
                markPoint: {
                    data: markPointRevisedValues
                },
            },
            {
                name:'Pendentes',
                type:'bar',
                data: chartist.expired,
                markPoint: {
                    data: markPointExpiredValues
                },
            }
        ]
    };
                        

    myChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                myChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
        
</script>

@endsection