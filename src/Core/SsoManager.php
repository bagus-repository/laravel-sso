<?php

namespace Dptsi\Sso\Core;

use Carbon\Carbon;
use Dptsi\Sso\Models\Role;
use Dptsi\Sso\Models\User;
use Dptsi\Sso\Requests\OidcLoginRequest;
use Dptsi\Sso\Requests\OidcLogoutRequest;
use Illuminate\Support\Facades\Session;
use Its\Sso\OpenIDConnectClient;

class SsoManager
{
    public function login(OidcLoginRequest $request): void
    {
        $oidc = new OpenIDConnectClient($request->getProvider(), $request->getClientId(), $request->getClientSecret());

        $oidc->setRedirectURL($request->getRedirectUri());

        $oidc->addScope($request->getScope());

        if (strtolower(config('app.env')) != 'production' && strtolower(config('app.env')) != 'prod') {
            $oidc->setVerifyHost(false);
            $oidc->setVerifyPeer(false);
        }

        $oidc->authenticate();

        $userInfo = $oidc->requestUserInfo();

        $user = new User(
            $userInfo->sub,
            $userInfo->name ?? null,
            $userInfo->nickname ?? null,
            $userInfo->picture ?? null,
            $userInfo->gender ?? null,
            $userInfo->birthdate ? new Carbon($userInfo->birthdate) : null,
            $userInfo->zoneinfo ?? null,
            $userInfo->locale ?? null,
            $userInfo->preferred_username ?? null,
            $userInfo->email ?? null,
            $userInfo->email_verified ?? null,
            $userInfo->alternate_email ?? null,
            $userInfo->alternate_email_verified ?? null,
            $userInfo->phone ?? null,
            $userInfo->phone_verified ?? null,
            $userInfo->resource ? json_decode(json_encode($userInfo->resource), true) : null,
            $userInfo->integra_id ?? null,
        );

        foreach ($userInfo->group as $group) {
            if (in_array($group->group_name, config('openid.allowed_roles'))) {
                $user->addUserRole(new Role($group->group_name, null, null, null));
            }
        }

        foreach ($userInfo->role as $role) {
            if (in_array($role->role_name, config('openid.allowed_roles'))) {
                $newRole = new Role(
                    $role->role_name,
                    $role->org_id,
                    $role->org_name,
                    $role->expired_at ? new Carbon($role->expired_at) : null,
                );
                $user->addUserRole($newRole);
                if ($role->is_default === '1')
                    $user->setActiveRole($newRole);
            }
        }

        if (!empty($user->getRoles()) && empty($user->getActiveRole()))
            $user->setActiveRole($user->getRoles()[0] ?? null);

        Session::put('sso.user', serialize($user));

        Session::put('sso.id_token', $oidc->getIdToken());

        Session::put('sso.access_token', $oidc->getAccessToken());
    }

    public function logout(OidcLogoutRequest $request): void
    {
        $accessToken = Session::get('sso.id_token');

        Session::remove('sso');

        Session::save();

        $redirect = $request->getPostLogoutRedirectUri();

        $oidc = new OpenIDConnectClient($request->getProvider(), $request->getClientId(), $request->getClientSecret());

        if (strtolower(config('app.env')) != 'production' && strtolower(config('app.env')) != 'prod') {
            $oidc->setVerifyHost(false);
            $oidc->setVerifyPeer(false);
        }

        $oidc->signOut($accessToken, $redirect);
    }

    public function check(): bool
    {
        if (Session::has('sso.user') == null)
            return false;
        return Session::has('sso.user');
    }

    public function user(): ?User
    {
        return unserialize(Session::get('sso.user'));
    }

    public function set(User $user): void
    {
        Session::put('sso.user', serialize($user));
    }

    public function token(): ?string
    {
        return Session::get('sso.id_token');
    }

    public function accessToken(): ?string
    {
        return Session::get('sso.access_token');
    }
}
