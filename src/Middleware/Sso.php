<?php


namespace Forisa\Sso\Middleware;


use Closure;

class Sso
{
    public function handle($request, Closure $next)
    {
        if (config('forisasso.check_token_type') == 'session' ? \Forisa\Sso\Facade\Sso::checkBySession():\Forisa\Sso\Facade\Sso::check()) {
            return $next($request);
        }

        return redirect(route('sso.redirect'));
    }

}
