<?php

namespace Dptsi\Sso\Requests;

class OidcLogoutRequest
{
    private $provider;
    private $clientId;
    private $clientSecret;
    private $postLogoutRedirectUri;

    public function __construct(
        $provider,
        $clientId,
        $clientSecret,
        $postLogoutRedirectUri
    ) {
        $this->provider = $provider;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->postLogoutRedirectUri = $postLogoutRedirectUri;
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

    public function getPostLogoutRedirectUri()
    {
        return $this->postLogoutRedirectUri;
    }
}

