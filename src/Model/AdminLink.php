<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Model;

final readonly class AdminLink
{
    /** @param array<string, mixed> $routeParameters */
    public function __construct(
        public string $label,
        public ?string $route = null,
        public array $routeParameters = [],
        public ?string $url = null,
        public ?string $icon = null,
        public ?string $description = null,
        public ?string $target = null,
    ) {
    }
}
