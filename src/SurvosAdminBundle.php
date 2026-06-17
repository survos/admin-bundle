<?php

declare(strict_types=1);

namespace Survos\AdminBundle;

use Survos\AdminBundle\Contract\AdminContributorInterface;
use Survos\AdminBundle\Service\AdminRegistry;
use Survos\Kit\AbstractSurvosBundle;
use Survos\Kit\Traits\HasConfigurableRoutes;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

// Symfony\Component\HttpKernel\Bundle\Bundle <-- Flex auto-registration marker (see Survos\Kit\AbstractSurvosBundle)
final class SurvosAdminBundle extends AbstractSurvosBundle
{
    use HasConfigurableRoutes;

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $this->addRouteLoaderCompilerPass($container);

        $container
            ->registerForAutoconfiguration(AdminContributorInterface::class)
            ->addTag(AdminContributorInterface::TAG);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $children = $definition->rootNode()->children();
        $this->addRouteOptions($children, '/admin');
        $children
            ->scalarNode('title')->defaultValue('Admin')->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $this->captureRouteConfig($config);
        parent::loadExtension($config, $container, $builder);
        $this->registerRouteLoader($builder);

        $services = $container->services()
            ->defaults()
            ->autowire()
            ->autoconfigure();

        $services->load('Survos\\AdminBundle\\Service\\', __DIR__ . '/Service/');
        $services->set(AdminRegistry::class)
            ->arg('$contributors', new TaggedIteratorArgument(AdminContributorInterface::TAG))
            ->arg('$title', $config['title']);
    }
}
