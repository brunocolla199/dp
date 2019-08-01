<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{DadosDocumento, User};
use App\Jobs\SendEmailsJob;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function teste(){
        try {
            $user = User::find(1);
            Log::info("### WEE_LOG ### Teste de envio de e-mail [".now()."]!");
            Log::info("### WEE_LOG ### Destinatário = $user->name [".$user->email."]!");

            // [E-mail -> (O documento irá vencer em 30 dias)]
            $icon = "info";
            $contentF1_P1 = "O documento "; $codeF1 = "COD-TESTE-01"; $contentF1_P2 = " vai vencer em 30 dias.";
            $labelF2 = "Tipo do Documento: "; $valueF2 = "Diretrizes de Teste";
            $labelF3 = "Título do Documento: "; $valueF3 = "O título é sempre aqui"; $label2_F3 = ""; $value2_F3 = "";

            if( $user->name == 'Speed'  &&  $user->id = 1 ) {
                dispatch(new SendEmailsJob($user, "Validade do documento " . $codeF1 . " expira em um mês",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
            }  
        } catch (Exception $e) {
            dd($e);
        }

        return view('teste');
    }
}
