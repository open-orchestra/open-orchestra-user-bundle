<?php

namespace OpenOrchestra\Backoffice\Tests\Validator\Constraints;

use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use Symfony\Component\Validator\Constraint;
use OpenOrchestra\UserBundle\Validator\Constraints\ComplexUserPassword;

/**
 * Class ComplexUserPasswordTest
 */
class ComplexUserPasswordTest extends AbstractBaseTestCase
{
    /**
     * @var ContentTemplate
     */
    protected $constraint;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->constraint = new ComplexUserPassword();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\Validator\Constraint', $this->constraint);
    }

    /**
     * test message
     */
    public function testMessages()
    {
        $this->assertSame('open_orchestra_user.form.registration_user.complex_user_password', $this->constraint->message);
    }

    /**
     * Test validate by
     */
    public function testValidateBy()
    {
        $this->assertSame('complex_user_password', $this->constraint->validatedBy());
    }
}
