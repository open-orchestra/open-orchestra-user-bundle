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

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->form = new UserType($this->translator);
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\Form\AbstractType', $this->form);
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

        Phake::verify($this->builder, Phake::never())->add(Phake::anyParameters());
        Phake::verify($this->builder)->addEventSubscriber(Phake::anyParameters());
    }

    /**
     * Test resolver
     */
    public function testSetDefaultOptions()
    {
        $this->form->setDefaultOptions($this->resolver);

        Phake::verify($this->resolver)->setDefaults(array(
            'data_class' => 'OpenOrchestra\UserBundle\Document\User'
        ));
    }
}
