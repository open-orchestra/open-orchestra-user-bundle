<?php

namespace OpenOrchestra\UserBundle\Test\Twig;

use Phake;
use OpenOrchestra\UserBundle\Twig\DisplayLayoutExtension;

/**
 * Class DisplayLayoutExtensionTest
 */
class DisplayLayoutExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $container;
    protected $twig;
    protected $output = 'fake_twig_output';

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->container = Phake::mock('Symfony\Component\DependencyInjection\Container');
        Phake::when($this->container)->getParameter(Phake::anyParameters())->thenReturn($this->output);
        $this->twig = new DisplayLayoutExtension($this->container);
    }

    /**
     * test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Twig_Extension', $this->twig);
    }

    /**
     * Test displayLayout
     */
    public function testDisplayLayout()
    {
        $this->assertEquals($this->twig->displayLayout(), $this->output);
    }
}
