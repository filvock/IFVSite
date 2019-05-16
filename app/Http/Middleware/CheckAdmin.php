<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()){
            return redirect()->route('login');            
        }
        
        $role = auth()->user()->user_role;
        
        if (strcmp($role, "Admin")!=0 && 
            strcmp($role, "PresidenteNacional")!=0  && 
            strcmp($role, "PresidenteRegional")!=0  &&
            strcmp($role, "PresidenteEstadual")!=0 ) {
            
            return redirect('/');
        }
        return $next($request);
    }
}
