<?php

namespace Dptsi\Sso\Models;

class PersonalInfo
{
    private UserId $userId;
    private string $name;
    private ?string $nickname;
    private ?string $picture;

    public function __construct(
        UserId $userId,
        string $name,
        ?string $nickname,
        ?string $picture
    )
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->picture = $picture;
    }

    public function getUserId() : UserId
    {
        return $this->userId;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getNickname() : ?string
    {
        return $this->nickname;
    }

    public function getPicture() : ?string
    {
        return $this->picture;
    }

}