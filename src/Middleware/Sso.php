<?php


namespace Dptsi\Sso\Middleware;


use Closure;
use Illuminate\Support\Facades\Session;

class Sso
{
    public function handle($request, Closure $next)
    {
        if (Session::has('auth.user')) {
            return $next($request);
        }

        return redirect(config('openid.redirect_uri'));
    }

}
