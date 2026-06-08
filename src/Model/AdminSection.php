<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Model;

final readonly class AdminSection
{
    /**
     * @param list<AdminLink> $links
     * @param list<AdminCard> $cards
     */
    public function __construct(
        public string $code,
        public string $label,
        public ?string $description = null,
        public ?string $icon = null,
        public string $group = 'System',
        public int $priority = 0,
        public array $links = [],
        public array $cards = [],
    ) {
    }
}
