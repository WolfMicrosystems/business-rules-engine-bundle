<?php
namespace WMS\Bundle\BusinessRulesEngineBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use WMS\Bundle\BusinessRulesEngineBundle\DependencyInjection\Compiler\ExpressionLanguageExtensionPass;
use WMS\Bundle\BusinessRulesEngineBundle\DependencyInjection\Compiler\RulesResolverPass;

class WMSBusinessRulesEngineBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RulesResolverPass());
        $container->addCompilerPass(new ExpressionLanguageExtensionPass());
    }
}