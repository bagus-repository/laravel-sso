<?php

namespace Dptsi\Sso\Models;

use Ramsey\Uuid\Uuid;

class OrganizationUnitId
{
    private $id;

    public function __construct($id = null)
    {
        if (Uuid::isValid($id)) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException("Invalid OrganizationUnitId format.");
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function equals(OrganizationUnitId $unitOrganisasiId)
    {
        return $this->id === $unitOrganisasiId->id;
    }

}