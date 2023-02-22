<?php
 
namespace Maestro\Users\Http\Middleware;
 
use Closure;
use Maestro\Users\Support\Facade\Users;

class AuthenticatesUsers
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (! Users::auth()->isLogged()) {
            return redirect()->route('maestro.users.login');
        }

        return $next($request);
    }
}