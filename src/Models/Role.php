<?php

namespace Forisa\Sso\Models;

class Role
{
    private $name;
    private $org_id;
    private $org_name;
    private $expired_at;

    /**
     * Role constructor.
     * @param string $name
     * @param string|null $org_id
     * @param string|null $org_name
     * @param Carbon|null $expired_at
     */
    public function __construct(
        $name,
        $org_id,
        $org_name,
        $expired_at
    ) {
        $this->name = $name;
        $this->org_id = $org_id;
        $this->org_name = $org_name;
        $this->expired_at = $expired_at;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getOrgId(): ?string
    {
        return $this->org_id;
    }

    /**
     * @return string|null
     */
    public function getOrgName(): ?string
    {
        return $this->org_name;
    }

    /**
     * @return string|null
     */
    public function getExpiredAt(): ?string
    {
        return $this->expired_at;
    }
}
