<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->get('/sso/force-logout', function (){
    // $request = new OidcLogoutRequest(
    //     config('openid.provider'),
    //     config('openid.client_id'),
    //     config('openid.client_secret'),
    //     config('openid.post_logout_redirect_uri')
    // );

    // Sso::logout($request);
});

Route::prefix('sso')->middleware('web')->group(function(){
    Route::get('/redirect', 'Forisa\Sso\Core\SsoManager@redirect')->name('sso.redirect');
    Route::get('/callback', 'Forisa\Sso\Core\SsoManager@callback')->name('sso.callback');
    Route::get('/logout', 'Forisa\Sso\Core\SsoManager@logout')->name('sso.logout');
});
