<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        // return $next($request);
        $user = Auth::user();

        if($user->level == "admin")
            return $next($request);

        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->level == $role)
                return $next($request);
        }

        return abort(403, 'Anda tidak memiliki hak akses');
    }
}
