<?php

namespace Dptsi\Sso\Models;

class OrganizationUnit
{
    private OrganizationUnitId $id;
    private string $name;

    public function __construct(
        OrganizationUnitId $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): OrganizationUnitId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}