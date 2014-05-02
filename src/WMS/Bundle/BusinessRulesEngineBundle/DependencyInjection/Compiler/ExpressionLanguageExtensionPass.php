<?php

namespace WMS\Bundle\BusinessRulesEngineBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExpressionLanguageExtensionPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('wms.business_rules_engine')) {
            return;
        }

        $definition = $container->getDefinition('wms.business_rules_engine');

        foreach ($container->findTaggedServiceIds('wms.business_rules_engine.extension') as $id => $attributes) {
            $definition->addMethodCall('registerExtension', array(new Reference($id)));
        }
    }

} 