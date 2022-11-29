<?php

namespace Forisa\Sso\Requests;

class SSOLoginRequest
{
    private $AppCode;
    private $RedirectUrl;
    private $DeviceId;

    public function __construct(
        $AppCode
        ,$RedirectUrl
        ,$DeviceId
    ) {
        $this->AppCode = $AppCode;
        $this->RedirectUrl = $RedirectUrl;
        $this->DeviceId = $DeviceId;
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
     * Get the value of RedirectUrl
     */ 
    public function getRedirectUrl()
    {
        return $this->RedirectUrl;
    }

    /**
     * Set the value of RedirectUrl
     *
     * @return  self
     */ 
    public function setRedirectUrl($RedirectUrl)
    {
        $this->RedirectUrl = $RedirectUrl;

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
}