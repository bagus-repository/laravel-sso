<?php

namespace Dptsi\Sso\Core;

use Dptsi\Sso\Models\Account;
use Dptsi\Sso\Models\OrganizationUnit;
use Dptsi\Sso\Models\OrganizationUnitId;
use Dptsi\Sso\Models\PersonalInfo;
use Dptsi\Sso\Models\Role;
use Dptsi\Sso\Models\User;
use Dptsi\Sso\Models\UserId;
use Dptsi\Sso\Requests\OidcLoginRequest;
use Dptsi\Sso\Requests\OidcLogoutRequest;
use Illuminate\Support\Facades\Session;
use Its\Sso\OpenIDConnectClient;

class AuthManager
{
    public function loginSso(OidcLoginRequest $request)
    {
        $oidc = new OpenIDConnectClient($request->getProvider(), $request->getClientId(), $request->getClientSecret());

        $oidc->setRedirectURL($request->getRedirectUri());

        $oidc->addScope($request->getScope());

        if(config('app.env') != 'production' || config('app.env') != 'PRODUCTION') {
            $oidc->setVerifyHost(false);
            $oidc->setVerifyPeer(false);
        }

        $oidc->authenticate();

        $userInfo = $oidc->requestUserInfo();

        $userId = new UserId($userInfo->sub);
        $resourceClaim = json_decode(json_encode($userInfo->resource), true);

        $user = new User(
            $userId,
            new Account(
                $userId,
                $userInfo->preferred_username,
                $userInfo->email,
                $userInfo->email_verified,
                $userInfo->alternate_email,
                $userInfo->alternate_email_verified,
                $userInfo->phone,
                $userInfo->phone_verified
            ),
            new PersonalInfo(
                $userId,
                $userInfo->name,
                $userInfo->nickname,
                $userInfo->picture
            ),
            $resourceClaim
        );

        $defaultRole = null;

        foreach ($userInfo->group as $group) {
             if(in_array($group->group_name, config('openid.allowed_roles'), false)) {
                $user->addUserRole(
                    new Role($group->group_name, null)
                );
             }
        }

        foreach ($userInfo->role as $role) {
             if(in_array($role->role_name, config('openid.allowed_roles'), false)) {
                $newRole = new Role($role->role_name, new OrganizationUnit(new OrganizationUnitId($role->org_id), $role->org_name));
                $user->addUserRole($newRole);
                if ($role->is_default === '1')
                    $defaultRole = $newRole;
             }
        }

        if (!empty($user->getUserRoles())) {
            if ($defaultRole) {
                $user->setActiveRole($defaultRole);
            } else {
                $user->setActiveRole($user->getUserRoles()[0]);
            }
        }

        Session::put('auth.user', serialize($user));

        Session::put('auth.id_token', $oidc->getIdToken());
    }

    public function logoutSso(OidcLogoutRequest $request)
    {
        $accessToken = Session::get('auth.id_token');

        Session::remove('auth');

        Session::save();

        $redirect = $request->getPostLogoutRedirectUri();

        $oidc = new OpenIDConnectClient($request->getProvider(), $request->getClientId(), $request->getClientSecret());

        if(config('app.env') != 'production' || config('app.env') != 'PRODUCTION') {
            $oidc->setVerifyHost(false);
            $oidc->setVerifyPeer(false);
        }

        $oidc->signOut($accessToken, $redirect);
    }

    public function check(): ?bool
    {
        return Session::has('auth.user');
    }

    public function user(): ?User
    {
        return unserialize(Session::get('auth.user'));
    }

    public function set(User $user)
    {
        Session::put('auth.user', serialize($user));
    }

    public function token(): ?string
    {
        return Session::get('auth.id_token');
    }

    public function roles(): ?array
    {
        $formatted = [];

        foreach ($this->user()->getUserRoles() as $role) {
            $formatted[] = [
                'name' => $role->getName(),
                'org_id' => $role->getOrganizationUnit() ? $role->getOrganizationUnit()->getId()->id() : null,
                'org_name' => $role->getOrganizationUnit() ? $role->getOrganizationUnit()->getName() : null
            ];
        }

        return $formatted;
    }

    public function activeRole(): ?array
    {
        return [
            'name' => $this->user()->getActiveRole()->getName(),
            'org_id' => $this->user()->getActiveRole()->getOrganizationUnit() ? $this->user()->getActiveRole()->getOrganizationUnit()->getId()->id() : null,
            'org_name' => $this->user()->getActiveRole()->getOrganizationUnit() ? $this->user()->getActiveRole()->getOrganizationUnit()->getName() : null
        ];
    }
}
