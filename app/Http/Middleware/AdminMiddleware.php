<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //Los roles estan guardados como numeros
        switch($role) {
            case 'user': $val=0; break;
            case 'editor': $val=1; break;
            case 'admin': $val=2; break;
            default: $val=10; break;
        }
        if($request->user()&&$request->user()->rol<$val) {
            return response('Not authorizated', 401);
        } else {
            return $next($request);
        }
    }
}
