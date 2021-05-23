<?php

use Dptsi\Sso\Facade\Sso;
use Dptsi\Sso\Requests\OidcLogoutRequest;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->get('/sso/force-logout', function (){
    $request = new OidcLogoutRequest(
        config('openid.provider'),
        config('openid.client_id'),
        config('openid.client_secret'),
        config('openid.post_logout_redirect_uri')
    );

    Sso::logout($request);
});
