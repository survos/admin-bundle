<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Model;

final readonly class AdminCard
{
    public function __construct(
        public string $label,
        public string|int|null $value = null,
        public ?string $description = null,
        public ?string $icon = null,
        public ?AdminLink $link = null,
    ) {
    }
}
