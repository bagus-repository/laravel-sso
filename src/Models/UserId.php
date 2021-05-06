<?php

namespace Dptsi\Sso\Models;

use Ramsey\Uuid\Uuid;

class UserId
{
    private $id;

    public function __construct($id = null)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid UserId format.");
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function equals(UserId $userId)
    {
        return $this->id === $userId->id;
    }

}