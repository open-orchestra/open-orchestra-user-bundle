<?php

namespace OpenOrchestra\Backoffice\Tests\Validator\Constraints;

use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use OpenOrchestra\UserBundle\Validator\Constraints\ComplexUserPassword;

/**
 * Class ComplexUserPasswordTest
 */
class ComplexUserPasswordTest extends AbstractBaseTestCase
{
    /**
     * @var ComplexUserPassword
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
        $this->assertSame('open_orchestra_user.form.registration_user.complex_user_password', $this->constraint->messageComplexUserPassword);
        $this->assertSame('open_orchestra_user.form.registration_user.current_password_needed', $this->constraint->messageCurrentPasswordNeeded);
        $this->assertSame('open_orchestra_user.form.registration_user.current_password_incorrect', $this->constraint->messageCurrentPasswordIncorrect);
    }

    /**
     * Test validate by
     */
    public function testValidateBy()
    {
        $this->assertSame('complex_user_password', $this->constraint->validatedBy());
    }
}
