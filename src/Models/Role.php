<?php

namespace Dptsi\Sso\Models;

use Carbon\Carbon;

class Role
{
    private string $name;
    private ?string $org_id;
    private ?string $org_name;
    private ?Carbon $expired_at;

    /**
     * Role constructor.
     * @param string $name
     * @param string|null $org_id
     * @param string|null $org_name
     * @param Carbon|null $expired_at
     */
    public function __construct(
        string $name,
        ?string $org_id,
        ?string $org_name,
        ?Carbon $expired_at
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
     * @return Carbon|null
     */
    public function getExpiredAt(): ?Carbon
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
