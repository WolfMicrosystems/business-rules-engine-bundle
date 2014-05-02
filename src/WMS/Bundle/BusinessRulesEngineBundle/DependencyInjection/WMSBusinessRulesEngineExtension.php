<?php
namespace WMS\Bundle\BusinessRulesEngineBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class WMSBusinessRulesEngineExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $configs   An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        if (empty($config['resource'])) {
            return;
        }

        $loader->load('business-rules-engine.xml');

        $container->setParameter('wms.business_rules_engine.resource', $config['resource']);
        $container->setParameter('wms.business_rules_engine.cache_class_prefix', $container->getParameter('kernel.name') . ucfirst($container->getParameter('kernel.environment')));
    }
}