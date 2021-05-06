<?php

namespace Dptsi\Sso\Models;

class Role
{
    private string $name;
    private ?OrganizationUnit $organizationUnit;

    public function __construct(
        string $name,
        ?OrganizationUnit $organizationUnit
    )
    {
        $this->name = $name;
        $this->organizationUnit = $organizationUnit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOrganizationUnit(): ?OrganizationUnit
    {
        return $this->organizationUnit;
    }
}
