<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Contract;

use Survos\AdminBundle\Model\AdminSection;

interface AdminContributorInterface
{
    public const TAG = 'survos.admin.contributor';

    /**
     * @return iterable<AdminSection>
     */
    public function getAdminSections(): iterable;
}
