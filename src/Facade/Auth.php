<?php


namespace Dptsi\Sso\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class ModuleManager
 * @package Dptsi\Sso\Facade
 * @method static void loginSso(OidcRequest $request)
 * @method static void logoutSso()
 * @method static ?bool check()
 * @method static ?\Dptsi\Sso\Models\User user()
 * @method static void set(\Dptsi\Sso\Models\User $user)
 * @method static ?string token()
 * @method static ?array roles()
 * @method static ?array activeRole()
 */

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }
}
