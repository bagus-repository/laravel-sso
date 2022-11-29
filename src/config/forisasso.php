<?php

return [
    'app_code'                  => env('FORISASSO_APP_CODE'),
    'base_url'                  => env('FORISASSO_BASE_URL'),
    'api_url'                 => env('FORISASSO_API_URL'),
    'post_login_redirect_uri'   => env('FORISASSO_POST_LOGIN_REDIRECT_URI'),
    'post_logout_redirect_uri'  => env('FORISASSO_POST_LOGOUT_REDIRECT_URI'),
    'scope'                     => env('FORISASSO_SCOPE'),
    'allowed_roles'             => [
        'Role1',
        'Role2',
        'Role3'
    ],
];