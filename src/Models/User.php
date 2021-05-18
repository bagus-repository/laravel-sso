<?php

namespace Dptsi\Sso\Models;

class User
{
    private UserId $id;

    private Account $account;

    private PersonalInfo $personalInfo;

    /** @var Role[] */
    private $userRoles;

    /** @var Role */
    private $activeRole;

    private $resources;

    public function __construct(
        UserId $userId,
        Account $account,
        PersonalInfo $personalInfo,
        array $resources
    )
    {
        $this->id = $userId;
        $this->account = $account;
        $this->personalInfo = $personalInfo;
        $this->userRoles = array();
        $this->resources = $resources;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getPersonalInfo(): PersonalInfo
    {
        return $this->personalInfo;
    }

    public function getUserRoles(): array
    {
        return $this->userRoles;
    }

    public function getActiveRole(): ?Role
    {
        return $this->activeRole;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function setActiveRole(Role $activeRole): void
    {
        $this->activeRole = $activeRole;
    }

    public function addUserRole(Role $role)
    {
        if (!in_array($role, $this->userRoles, false)) {
            $this->userRoles[] = $role;
        }
    }

    public function canRead(string $path): bool
    {
        foreach ($this->resources[$this->getActiveRole()->getName()] as $resource) {
            if ($resource['path'] === $path) {
                return true;
            }
        }

        return false;
    }

    public function canEdit(string $path): bool
    {
        return $this->can('can_update', $path);
    }

    public function canInsert(string $path): bool
    {
        return $this->can('can_insert', $path);
    }

    public function canDelete(string $path): bool
    {
        return $this->can('can_delete', $path);
    }

    private function can(string $action, string $path): bool
    {
        foreach ($this->resources[$this->getActiveRole()->getName()] as $resource) {
            if ($resource['path'] === $path && $resource[$action]) {
                return true;
            }
        }

        return false;
    }
}
