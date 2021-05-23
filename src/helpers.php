<?php


if (!function_exists('sso')) {
    /**
     * @return \Dptsi\Sso\Core\SsoManager|null
     */
    function sso()
    {
        return app(\Dptsi\Sso\Core\SsoManager::class) ?? null;
    }
}
