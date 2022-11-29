<?php

namespace Forisa\Sso\Models;
class User
{
    private $AccessToken;
    private $EmployeeNo;
    private $EmployeeName;
    private $DeviceId;
    
    // // openid claim
    // private string $id;

    // // profile claim
    // private ?string $name;
    // private ?string $nickname;
    // private ?string $picture;
    // private ?string $gender;
    // private ?Carbon $birthdate;
    // private ?string $zoneinfo;
    // private ?string $locale;
    // private ?string $username;

    // // email claim
    // private ?string $email;
    // private ?bool $email_verified;
    // private ?string $alternate_email;
    // private ?bool $alternate_email_verified;

    // // phone claim
    // private ?string $phone;
    // private ?bool $phone_verified;

    // // group or role claim
    // private ?array $roles;
    // private ?Role $active_role;

    // // resource claim
    // private ?array $resources;

    // // integra claim
    // private ?string $integra_id;

    // /**
    //  * User constructor.
    //  * @param string $id
    //  * @param string|null $name
    //  * @param string|null $nickname
    //  * @param string|null $picture
    //  * @param string|null $gender
    //  * @param Carbon|null $birthdate
    //  * @param string|null $zoneinfo
    //  * @param string|null $locale
    //  * @param string|null $username
    //  * @param string|null $email
    //  * @param bool|null $email_verified
    //  * @param string|null $alternate_email
    //  * @param bool|null $alternate_email_verified
    //  * @param string|null $phone
    //  * @param bool|null $phone_verified
    //  * @param array|null $resources
    //  * @param string|null $integra_id
    //  */
    // public function __construct(string $id,
    //     ?string $name,
    //     ?string $nickname,
    //     ?string $picture,
    //     ?string $gender,
    //     ?Carbon $birthdate,
    //     ?string $zoneinfo,
    //     ?string $locale,
    //     ?string $username,
    //     ?string $email,
    //     ?bool $email_verified,
    //     ?string $alternate_email,
    //     ?bool $alternate_email_verified,
    //     ?string $phone,
    //     ?bool $phone_verified,
    //     ?array $resources,
    //     ?string $integra_id
    // ) {
    //     $this->id = $id;
    //     $this->name = $name;
    //     $this->nickname = $nickname;
    //     $this->picture = $picture;
    //     $this->gender = $gender;
    //     $this->birthdate = $birthdate;
    //     $this->zoneinfo = $zoneinfo;
    //     $this->locale = $locale;
    //     $this->username = $username;
    //     $this->email = $email;
    //     $this->email_verified = $email_verified;
    //     $this->alternate_email = $alternate_email;
    //     $this->alternate_email_verified = $alternate_email_verified;
    //     $this->phone = $phone;
    //     $this->phone_verified = $phone_verified;
    //     $this->roles = array();
    //     $this->active_role = null;
    //     $this->resources = $resources;
    //     $this->integra_id = $integra_id;
    // }

    // /**
    //  * @return string
    //  */
    // public function getId(): string
    // {
    //     return $this->id;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getName(): ?string
    // {
    //     return $this->name;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getNickname(): ?string
    // {
    //     return $this->nickname;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getPicture(): ?string
    // {
    //     return $this->picture;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getGender(): ?string
    // {
    //     return $this->gender;
    // }

    // /**
    //  * @return Carbon|null
    //  */
    // public function getBirthdate(): ?Carbon
    // {
    //     return $this->birthdate;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getZoneinfo(): ?string
    // {
    //     return $this->zoneinfo;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getLocale(): ?string
    // {
    //     return $this->locale;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getUsername(): ?string
    // {
    //     return $this->username;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getEmail(): ?string
    // {
    //     return $this->email;
    // }

    // /**
    //  * @return bool|null
    //  */
    // public function getEmailVerified(): ?bool
    // {
    //     return $this->email_verified;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getAlternateEmail(): ?string
    // {
    //     return $this->alternate_email;
    // }

    // /**
    //  * @return bool|null
    //  */
    // public function getAlternateEmailVerified(): ?bool
    // {
    //     return $this->alternate_email_verified;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getPhone(): ?string
    // {
    //     return $this->phone;
    // }

    // /**
    //  * @return bool|null
    //  */
    // public function getPhoneVerified(): ?bool
    // {
    //     return $this->phone_verified;
    // }

    // /**
    //  * @return Role[]|null
    //  */
    // public function getRoles(): ?array
    // {
    //     return $this->roles;
    // }

    // /**
    //  * @return Role|null
    //  */
    // public function getActiveRole(): ?Role
    // {
    //     return $this->active_role;
    // }

    // /**
    //  * @return array|null
    //  */
    // public function getResources(): ?array
    // {
    //     return $this->resources;
    // }

    // /**
    //  * @return string|null
    //  */
    // public function getIntegraId(): ?string
    // {
    //     return $this->integra_id;
    // }

    // /**
    //  * @param Role $role
    //  *
    //  * @return void
    //  */
    // public function setActiveRole(Role $role): void
    // {
    //     $this->active_role = $role;
    // }

    // /**
    //  * @param Role $role
    //  *
    //  * @return void
    //  */
    // public function addUserRole(Role $role): void
    // {
    //     if (!in_array($role, $this->roles, false)) {
    //         $this->roles[] = $role;
    //     }
    // }

    // /**
    //  * @param string $path
    //  *
    //  * @return bool
    //  */
    // public function canRead(string $path): bool
    // {
    //     foreach ($this->resources[$this->getActiveRole()->getName()] as $resource) {
    //         if ($resource['path'] === $path) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    // /**
    //  * @param string $path
    //  * 
    //  * @return bool
    //  */
    // public function canEdit(string $path): bool
    // {
    //     return $this->can('can_update', $path);
    // }

    // /**
    //  * @param string $path
    //  * 
    //  * @return bool
    //  */
    // public function canInsert(string $path): bool
    // {
    //     return $this->can('can_insert', $path);
    // }

    // /**
    //  * @param string $path
    //  * 
    //  * @return bool
    //  */
    // public function canDelete(string $path): bool
    // {
    //     return $this->can('can_delete', $path);
    // }

    // /**
    //  * @param string $action
    //  * @param string $path
    //  * 
    //  * @return bool
    //  */
    // private function can(string $action, string $path): bool
    // {
    //     foreach ($this->resources[$this->getActiveRole()->getName()] as $resource) {
    //         if ($resource['path'] === $path && $resource[$action]) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    /**
     * Get the value of AccessToken
     */ 
    public function getAccessToken()
    {
        return $this->AccessToken;
    }

    /**
     * Set the value of AccessToken
     *
     * @return  self
     */ 
    public function setAccessToken($AccessToken)
    {
        $this->AccessToken = $AccessToken;

        return $this;
    }

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
}
