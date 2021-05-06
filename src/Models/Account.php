<?php

namespace Dptsi\Sso\Models;

class Account
{
    private UserId $userId;
    private string $username;
    private ?string $primaryEmail;
    private ?bool $primaryEmailVerified;
    private ?string $alternateEmail;
    private ?bool $alternateEmailVerified;
    private ?string $phone;
    private ?bool $phoneVerified;

    public function __construct(
        UserId $userId,
        string $username,
        ?string $primaryEmail,
        ?bool $primaryEmailVerified,
        ?string $alternateEmail,
        ?bool $alternateEmailVerified,
        ?string $phone,
        ?bool $phoneVerified
    )
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->primaryEmail = $primaryEmail;
        $this->primaryEmailVerified = $primaryEmailVerified;
        $this->alternateEmail = $alternateEmail;
        $this->alternateEmailVerified = $alternateEmailVerified;
        $this->phone = $phone;
        $this->phoneVerified = $phoneVerified;
    }

    public function getUserId() : UserId
    {
        return $this->userId;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getPrimaryEmail() : ?string
    {
        return $this->primaryEmail;
    }

    public function isPrimaryEmailVerified() : ?bool
    {
        return $this->primaryEmailVerified;
    }

    public function getAlternateEmail() : ?string
    {
        return $this->alternateEmail;
    }

    public function isAlternateEmailVerified() : ?bool
    {
        return $this->alternateEmailVerified;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }

    public function isPhoneVerified() : ?bool
    {
        return $this->phoneVerified;
    }

}