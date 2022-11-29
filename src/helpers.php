<?php


if (!function_exists('sso')) {
    /**
     * @return \Forisa\Sso\Core\SsoManager|null
     */
    function sso()
    {
        return app(\Forisa\Sso\Core\SsoManager::class) ?? null;
    }
}
