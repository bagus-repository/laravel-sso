<?php

namespace Dptsi\Sso\Models;

class Menu
{
    const TYPE_HEADER = 'header';
    const TYPE_NORMAL = 'normal';
    const TYPE_PARENT = 'parent';
    const TYPE_CHILD = 'child';

    private string $name;
    private ?string $url;
    private ?string $icon;
    private string $type;
    private bool $active;

    public function __construct(string $name, ?string $url, ?string $icon, string $type)
    {
        $this->name = $name;
        $this->url = $url;
        $this->icon = $icon;
        $this->type = $type;
        $this->active = false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}