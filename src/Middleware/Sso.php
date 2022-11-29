<?php


namespace Forisa\Sso\Middleware;


use Closure;

class Sso
{
    public function handle($request, Closure $next)
    {
        if (\Forisa\Sso\Facade\Sso::check()) {
            return $next($request);
        }

        return redirect(route('sso.redirect'));
    }

}
