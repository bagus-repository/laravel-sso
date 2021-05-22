<?php


namespace Dptsi\Sso\Middleware;


use Closure;

class Sso
{
    public function handle($request, Closure $next)
    {
        if (sso()->check()) {
            return $next($request);
        }

        return redirect(config('openid.redirect_uri'));
    }

}
