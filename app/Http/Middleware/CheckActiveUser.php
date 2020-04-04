<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckActiveUser
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
        if (auth()->user()->status != User::$status['active']['code']) {
            throw new UnauthorizedHttpException('jwt-auth', 'User is not active.'); 
        }
        return $next($request);
    }
}
