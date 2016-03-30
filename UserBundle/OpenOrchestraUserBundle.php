<?php

namespace OpenOrchestra\UserBundle;

use OpenOrchestra\UserBundle\DependencyInjection\Compiler\EntityResolverCompilerPass;
use OpenOrchestra\UserBundle\DependencyInjection\Compiler\TwigGlobalsCompilerPass;
use OpenOrchestra\UserBundle\DependencyInjection\Compiler\RoleUsageCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraUserBundle
 */
class OpenOrchestraUserBundle extends Bundle
{

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigGlobalsCompilerPass());
        $container->addCompilerPass(new EntityResolverCompilerPass());
        $container->addCompilerPass(new RoleUsageCompilerPass());
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
