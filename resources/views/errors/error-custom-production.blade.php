<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/dpworld.ico') }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	
    <!-- Bootstrap Core CSS -->
	<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	
    <!-- Custom CSS -->
    <link href="{{ asset('css/style-material-pro-main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-speed.css') }}" rel="stylesheet">

    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">
   
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>Erro</h1>
                <h3 class="text-uppercase">O sistema gerou um erro interno. Por favor, entre em contato com o suporte !</h3>
                <p class="text-muted m-t-30 m-b-30"> <b>(54) 2107-9100</b> | <b> contato@speedsoftware.com.br</b></p>
                <a href="{{ route('documentacao') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Voltar para a tela de documentação</a> </div>
            <footer class="footer text-center">© <a href="http://speedsoftware.com.br/" target="_blank">Speed Softwares</a></footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

</body>

</html>
