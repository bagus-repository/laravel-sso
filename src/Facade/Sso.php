<?php

namespace Forisa\Sso\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sso
 * @package Forisa\Sso\Facade
 * @method static void redirect()
 * @method static void SsoLoginButton()
 * @method static void logout(\Closure|null $beforeLogout)
 * @method static bool check()
 * @method static bool checkBySession()
 * @method static mixed getServerUser()
 * @method static \Forisa\Sso\Models\User|null user()
 * @method static void setUser(\Forisa\Sso\Models\User $user)
 * @method static string|null token()
 */

class Sso extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sso_manager';
    }
}
