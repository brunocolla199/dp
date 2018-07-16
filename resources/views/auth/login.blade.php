@extends('layouts.app')

@section('content')


<section id="wrapper">
    <div class="login-register" style="background-image: url({{ asset('images/bkg-login-dpworld.png') }});">       
        
        <div class="card">
            <div class="card-body">  
                
                <div class="row justify-content-md-center">
                    <div class="col-md-4">
                        <span class="pull-right custom-border-pink"></span>
                        <img src="{{ asset('images/dpworld-logo.jpg') }}" class="img-fluid" alt="DP World - Logo">
                    </div>
                    <div class="col-md-5" style="margin-top: 2%">
                        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} m-t-40">
                                <div class="col-xs-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="" autofocus placeholder="Usuário">
                                
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="password" type="password" class="form-control" name="password" required="" placeholder="Senha">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="checkbox-signup"> Mantenha-me conectado </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                                </div>
                            </div>
                        </form>

                        <form class="form-horizontal" id="recoverform" action="#">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <h3>Recuperação de Senha</h3>
                                    <p class="text-muted">Informe seu e-mail e instruções serão enviadas para você! </p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>


@endsection
