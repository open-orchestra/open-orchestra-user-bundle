<?php

namespace OpenOrchestra\UserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * Class TwigGlobalsCompilerPass
 */
class TwigGlobalsCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('twig')) {
            $twig = $container->getDefinition('twig');
            if ($container->hasParameter('open_orchestra_user.base_layout')) {
                $twig->addMethodCall('addGlobal', array('base_layout', new Parameter('open_orchestra_user.base_layout')));
            }
        }
    }

}
