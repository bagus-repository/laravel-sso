<?php


namespace Dptsi\Sso\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Sso
 * @package Dptsi\Sso\Facade
 * @method static void loginSso(\Dptsi\Sso\Requests\OidcLoginRequest $request)
 * @method static void logoutSso(\Dptsi\Sso\Requests\OidcLogoutRequest $request)
 * @method static bool check()
 * @method static \Dptsi\Sso\Models\User user()
 * @method static void set(\Dptsi\Sso\Models\User $user)
 * @method static string token()
 * @method static array roles()
 * @method static array activeRole()
 */

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'auth_manager';
    }
}
