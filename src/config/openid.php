<?php

return [
    'provider'                  => env('OPENID_PROVIDER'),
    'client_id'                 => env('OPENID_CLIENT_ID'),
    'client_secret'             => env('OPENID_CLIENT_SECRET'),
    'redirect_uri'              => env('OPENID_REDIRECT_URI'),
    'post_logout_redirect_uri'  => env('OPENID_POST_LOGOUT_REDIRECT_URI'),
    'scope'                     => env('OPENID_SCOPE'),
];