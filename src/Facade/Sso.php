<?php


namespace Dptsi\Sso\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Sso
 * @package Dptsi\Sso\Facade
 * @method static void login(\Dptsi\Sso\Requests\OidcLoginRequest $request)
 * @method static void logout(\Dptsi\Sso\Requests\OidcLogoutRequest $request)
 * @method static bool check()
 * @method static \Dptsi\Sso\Models\User user()
 * @method static void set(\Dptsi\Sso\Models\User $user)
 * @method static string token()
 * @method static array roles()
 * @method static array activeRole()
 */

class Sso extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sso_manager';
    }
}
