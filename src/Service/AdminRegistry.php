<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Service;

use Survos\AdminBundle\Contract\AdminContributorInterface;
use Survos\AdminBundle\Model\AdminSection;

final readonly class AdminRegistry
{
    /** @param iterable<AdminContributorInterface> $contributors */
    public function __construct(
        private iterable $contributors = [],
        private string $title = 'Admin',
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /** @return list<AdminSection> */
    public function sections(): array
    {
        $sections = [];
        foreach ($this->contributors as $contributor) {
            foreach ($contributor->getAdminSections() as $section) {
                $sections[] = $section;
            }
        }

        usort($sections, static fn (AdminSection $a, AdminSection $b): int => [$a->group, -$a->priority, $a->label] <=> [$b->group, -$b->priority, $b->label]);

        return $sections;
    }

    /** @return array<string, list<AdminSection>> */
    public function groupedSections(): array
    {
        $groups = [];
        foreach ($this->sections() as $section) {
            $groups[$section->group][] = $section;
        }

        return $groups;
    }
}
