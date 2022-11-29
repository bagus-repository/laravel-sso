<?php

namespace Forisa\Sso\Requests;

class SSOLogoutRequest
{
    private $AppCode;
    private $DeviceId;
    private $PostLogoutRedirectUri;

    public function __construct(
        $AppCode,
        $DeviceId,
        $PostLogoutRedirectUri
    ) {
        $this->AppCode = $AppCode;
        $this->DeviceId = $DeviceId;
        $this->PostLogoutRedirectUri = $PostLogoutRedirectUri;
    }

    /**
     * Get the value of AppCode
     */ 
    public function getAppCode()
    {
        return $this->AppCode;
    }

    /**
     * Set the value of AppCode
     *
     * @return  self
     */ 
    public function setAppCode($AppCode)
    {
        $this->AppCode = $AppCode;

        return $this;
    }

    /**
     * Get the value of DeviceId
     */ 
    public function getDeviceId()
    {
        return $this->DeviceId;
    }

    /**
     * Set the value of DeviceId
     *
     * @return  self
     */ 
    public function setDeviceId($DeviceId)
    {
        $this->DeviceId = $DeviceId;

        return $this;
    }

    /**
     * Get the value of PostLogoutRedirectUri
     */ 
    public function getPostLogoutRedirectUri()
    {
        return $this->PostLogoutRedirectUri;
    }

    /**
     * Set the value of PostLogoutRedirectUri
     *
     * @return  self
     */ 
    public function setPostLogoutRedirectUri($PostLogoutRedirectUri)
    {
        $this->PostLogoutRedirectUri = $PostLogoutRedirectUri;

        return $this;
    }
}

