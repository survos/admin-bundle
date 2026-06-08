<?php

declare(strict_types=1);

namespace Survos\AdminBundle\Controller;

use Survos\AdminBundle\Service\AdminRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('', name: 'survos_admin_dashboard')]
    public function __invoke(AdminRegistry $registry): Response
    {
        return $this->render('@SurvosAdmin/dashboard/index.html.twig', [
            'title' => $registry->getTitle(),
            'groups' => $registry->groupedSections(),
        ]);
    }
}
