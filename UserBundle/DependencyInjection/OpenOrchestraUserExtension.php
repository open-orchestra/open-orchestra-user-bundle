<?php

namespace OpenOrchestra\UserBundle\DependencyInjection;

use OpenOrchestra\UserBundle\DisplayBlock\LoginStrategy;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpenOrchestraUserExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->updateBlockParameter($container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('display.yml');
        $loader->load('validator.yml');

        if (!$container->hasParameter('open_orchestra_user.base_layout')) {
            $container->setParameter('open_orchestra_user.base_layout', $config['base_layout']);
        }
        if (!$container->hasParameter('open_orchestra_user.form_template')) {
            $container->setParameter('open_orchestra_user.form_template', $config['form_template']);
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function updateBlockParameter(ContainerBuilder $container)
    {
        $blockType = array(
            LoginStrategy::NAME,
        );

        $blocksAlreadySet = array();
        if ($container->hasParameter('open_orchestra.blocks')) {
            $blocksAlreadySet = $container->getParameter('open_orchestra.blocks');
        }
        $blocks = array_merge($blocksAlreadySet, $blockType);
        $container->setParameter('open_orchestra.blocks', $blocks);
    }
}
