<?php

namespace Forisa\Sso\Models;
class User
{
    private $EmployeeNo;
    private $EmployeeName;
    private $DeviceId;
    private $Email;

    /**
     * Get the value of EmployeeNo
     */ 
    public function getEmployeeNo()
    {
        return $this->EmployeeNo;
    }

    /**
     * Set the value of EmployeeNo
     *
     * @return  self
     */ 
    public function setEmployeeNo($EmployeeNo)
    {
        $this->EmployeeNo = $EmployeeNo;

        return $this;
    }

    /**
     * Get the value of EmployeeName
     */ 
    public function getEmployeeName()
    {
        return $this->EmployeeName;
    }

    /**
     * Set the value of EmployeeName
     *
     * @return  self
     */ 
    public function setEmployeeName($EmployeeName)
    {
        $this->EmployeeName = $EmployeeName;

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
     * Get the value of Email
     */ 
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Set the value of Email
     *
     * @return  self
     */ 
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }
}
