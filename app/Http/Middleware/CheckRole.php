<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckRole
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
        $role_id = Role::where('slug', $role)->firstOrFail()->id;
        if (auth()->user()->role_id != $role_id) {
            throw new UnauthorizedHttpException('jwt-auth', 'User doesn\'t have valid role');
        }
        return $next($request);
    }
}
