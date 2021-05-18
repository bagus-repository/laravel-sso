<?php

namespace Dptsi\Sso\Models;

use DateTime;

class OrganizationUnit
{
    private OrganizationUnitId $id;
    private string $name;
    private ?DateTime $expired_at;

    public function __construct(
        OrganizationUnitId $id, string $name, ?DateTime $expired_at
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->expired_at = $expired_at;
    }

    public function getId(): OrganizationUnitId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExpiredAt(): ?DateTime
    {
        return $this->expired_at;
    }

    public function isActive(): bool
    {
        if($this->expired_at === null)
            return true;
        return now() < $this->expired_at;
    }
}