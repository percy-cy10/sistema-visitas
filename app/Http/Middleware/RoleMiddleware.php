<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*class RoleMiddleware
{
    
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
} */


class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }
    
        return abort(403, 'No tienes permisos para acceder a esta página.');
    }
    
}