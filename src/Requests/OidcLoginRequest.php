<?php

namespace Dptsi\Sso\Requests;

class OidcLoginRequest
{
    private $provider;
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $scope;
    private $allowedRoles;

    public function __construct(
        $provider, $clientId, $clientSecret, $redirectUri, $scope, $allowedRoles
    )
    {
        $this->provider = $provider;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->scope = $scope;
        $this->allowedRoles = $allowedRoles;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function getAllowedRoles()
    {
        return $this->allowedRoles;
    }
}