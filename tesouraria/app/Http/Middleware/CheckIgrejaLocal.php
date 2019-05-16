<?php

namespace App\Http\Middleware;

use Closure;

class CheckIgrejaLocal
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()){
            return redirect()->route('login');            
        }
        
        $role = auth()->user()->user_role;
        
        if ($role != 'IgrejaLocal') {
            return redirect('/');
        }

        return $next($request);
    }
}
