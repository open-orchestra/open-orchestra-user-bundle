<?php

namespace OpenOrchestra\UserBundle\Twig;

use Symfony\Component\DependencyInjection\Container;

/**
 * Class DisplayLayoutExtension
 */
class DisplayLayoutExtension extends \Twig_Extension
{
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $block
     *
     * @return string
     */
    public function displayLayout()
    {
        return $this->container->getParameter('open_orchestra_user.base_layout');
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('display_layout', array($this, 'displayLayout'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'display_layout';
    }
}
