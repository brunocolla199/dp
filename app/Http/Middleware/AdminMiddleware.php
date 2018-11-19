<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\Constants;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! Auth::user()->permissao_elaborador || Auth::user()->setor_id != Constants::$ID_SETOR_QUALIDADE ) return redirect()->route('unauthorized');
        return $next($request);
    }
}
