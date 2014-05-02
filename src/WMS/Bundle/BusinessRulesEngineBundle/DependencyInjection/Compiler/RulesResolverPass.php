<?php

namespace WMS\Bundle\BusinessRulesEngineBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RulesResolverPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('wms.business_rules_engine.resolver')) {
            return;
        }

        $definition = $container->getDefinition('wms.business_rules_engine.resolver');

        foreach ($container->findTaggedServiceIds('wms.business_rules_engine.loader') as $id => $attributes) {
            $definition->addMethodCall('addLoader', array(new Reference($id)));
        }
    }

} 