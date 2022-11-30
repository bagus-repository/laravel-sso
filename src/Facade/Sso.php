<?php

namespace Forisa\Sso\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sso
 * @package Forisa\Sso\Facade
 * @method static void login(\Forisa\Sso\Requests\SSOLoginRequest $request)
 * @method static void logout(\Forisa\Sso\Requests\SSOLogoutRequest $request)
 * @method static bool check()
 * @method static bool checkBySession()
 * @method static \Forisa\Sso\Models\User|null user()
 * @method static void set(\Forisa\Sso\Models\User $user)
 * @method static string|null token()
 */

class Sso extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sso_manager';
    }
}
