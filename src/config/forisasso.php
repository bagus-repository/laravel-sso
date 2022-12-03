<?php

return [
    'check_token_type'          => env('FORISASSO_CHECK_TOKEN_TYPE', 'session'),
    'app_code'                  => env('FORISASSO_APP_CODE'),
    'base_url'                  => env('FORISASSO_BASE_URL'),
    'base_ip'                  => env('FORISASSO_BASE_IP'),
    'api_url'                   => env('FORISASSO_API_URL'),
    'api_ip'                   => env('FORISASSO_API_IP'),
    'post_login_redirect_uri'   => env('FORISASSO_POST_LOGIN_REDIRECT_URI'),
    'post_logout_redirect_uri'  => env('FORISASSO_POST_LOGOUT_REDIRECT_URI'),
    'scope'                     => env('FORISASSO_SCOPE'),
    'allowed_roles'             => [
        'Role1',
        'Role2',
        'Role3'
    ],
];