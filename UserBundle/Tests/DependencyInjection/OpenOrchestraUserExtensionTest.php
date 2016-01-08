<?php

namespace OpenOrchestra\BaseApiBundle\DependencyInjection;

use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use OpenOrchestra\UserBundle\DependencyInjection\OpenOrchestraUserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class OpenOrchestraUserExtensionTest
 */
class OpenOrchestraUserExtensionTest extends AbstractBaseTestCase
{
    /**
     * Test default value configuration
     */
    public function testDefaultConfig()
    {
        $container = $this->loadContainerFromFile('empty');

        $this->assertEquals('OpenOrchestraUserBundle::baseLayout.html.twig', $container->getParameter('open_orchestra_user.base_layout'));
        $this->assertEquals('OpenOrchestraUserBundle::form.html.twig', $container->getParameter('open_orchestra_user.form_template'));
    }

    /**
     * Test configuration with value
     */
    public function testConfigWithValue()
    {
        $container = $this->loadContainerFromFile('value');

        $this->assertEquals('base_layout_fake.html.twig', $container->getParameter('open_orchestra_user.base_layout'));
        $this->assertEquals('form_template_fake.html.twig', $container->getParameter('open_orchestra_user.form_template'));
    }

    /**
     * @param string $file
     *
     * @return ContainerBuilder
     */
    private function loadContainerFromFile($file)
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', false);
        $container->setParameter('kernel.cache_dir', '/tmp');
        $container->setParameter('fos_user.model.user.class', 'fake_fos_user.class');
        $container->registerExtension(new OpenOrchestraUserExtension());

        $locator = new FileLocator(__DIR__ . '/Fixtures/config/');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load($file . '.yml');
        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();

        return $container;
    }
}
