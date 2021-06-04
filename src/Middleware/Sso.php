<?php


namespace Dptsi\Sso\Middleware;


use Closure;

class Sso
{
    public function handle($request, Closure $next)
    {
        if (\Dptsi\Sso\Facade\Sso::check()) {
            if (empty(\Dptsi\Sso\Facade\Sso::user()->getRoles())) {
                return response()->view('Sso::illegitimate-role', [ 'provider' => config('openid.provider') ]);
            }
            return $next($request);
        }

        return redirect(config('openid.redirect_uri'));
    }

}
