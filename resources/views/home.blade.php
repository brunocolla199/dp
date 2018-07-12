@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Aqui serão colocados os gráficos. Os mesmos ainda não estão presentes em virtude de não existirem dados suficientes para alimentá-los.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
