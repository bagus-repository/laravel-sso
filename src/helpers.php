<?php

if (!function_exists('sso')) {
    /**
     * @return \Dptsi\Sso\Models\User|null
     */
    function sso()
    {
        return \Dptsi\Sso\Facade\Sso::user() ?? null;
    }
}