<?php

namespace OpenOrchestra\UserBundle\Test\Form\Type;

use Phake;
use OpenOrchestra\UserBundle\Form\Type\UserType;

/**
 * Class UserTypeTest
 */
class UserTypeTest extends AbstractUserTypeTest
{
    /**
     * @var UserType
     */
    protected $form;

    protected $class = 'OpenOrchestra\UserBundle\Document\User';

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->form = new UserType($this->class, $this->translator);
    }

    /**
     * Test name
     */
    public function testName()
    {
        $this->assertSame('user', $this->form->getName());
    }

    /**
     * Test builder
     */
    public function testBuilder()
    {
        $this->form->buildForm($this->builder, array());

        Phake::verify($this->builder, Phake::times(5))->add(Phake::anyParameters());
        Phake::verify($this->builder)->addEventSubscriber(Phake::anyParameters());
    }

    /**
     * Test setDefaultOptions
     */
    public function testResolver()
    {
        $this->form->setDefaultOptions($this->resolver);

        Phake::verify($this->resolver)->setDefaults(Phake::anyParameters());
    }
}
