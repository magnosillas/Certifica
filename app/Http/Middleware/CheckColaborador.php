<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Colaborador; 

class CheckColaborador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifique se o usuário está associado a algum registro na tabela colaboradores
        $colaborador = Colaborador::where('user_id', $request->user()->id)->first();

        if ($colaborador) {
            
            return $next($request);
        }

        return redirect('/home')->with('error', 'Acesso não autorizado para colaboradores.');
    }

    
}
