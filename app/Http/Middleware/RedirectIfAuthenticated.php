<?php

namespace App\Http\Middleware;

use Closure;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $reponse = $next($request);
        $reponse->headers->set('Cache-Control' , 'nocache , no-store , max-age=0, must-revalidate');
        $reponse->headers->set('Pragma','no-cache');
        $reponse->headers->set('Expires' , 'Sat, 01 Jan 2000 00:00:00 GMT');
        return $reponse;
    }
}
