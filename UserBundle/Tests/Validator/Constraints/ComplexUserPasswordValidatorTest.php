<?php

namespace OpenOrchestra\Backoffice\Tests\Validator\Constraints;

use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;
use Phake;
use OpenOrchestra\UserBundle\Validator\Constraints\ComplexUserPasswordValidator;

/**
 * Class ComplexUserPasswordValidatorTest
 */
class ComplexUserPasswordValidatorTest extends AbstractBaseTestCase
{
    /**
     * @var ContentTemplateValidator
     */
    protected $validator;
    protected $context;
    protected $constraint;
    protected $constraintViolationBuilder;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->constraint = Phake::mock('Symfony\Component\Validator\Constraint');
        $this->context = Phake::mock('Symfony\Component\Validator\Context\ExecutionContextInterface');
        $this->constraintViolationBuilder = Phake::mock('Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface');

        Phake::when($this->context)->buildViolation(Phake::anyParameters())->thenReturn($this->constraintViolationBuilder);
        Phake::when($this->constraintViolationBuilder)->setParameter(Phake::anyParameters())->thenReturn($this->constraintViolationBuilder);

        $this->validator = new ComplexUserPasswordValidator();
        $this->validator->initialize($this->context);
    }

    /**
     * Test instance
     */
    public function testClass()
    {
        $this->assertInstanceOf('Symfony\Component\Validator\ConstraintValidator', $this->validator);
    }

    /**
     * @param string $password
     * @param int    $violationTimes
     *
     * @dataProvider providePasswordAndViolationCount
     */
    public function testAddViolationOrNot($password, $violationTimes)
    {
        $this->validator->validate($password, $this->constraint);

        Phake::verify($this->context, Phake::times($violationTimes))->buildViolation(Phake::anyParameters());
    }

    /**
     * @return array
     */
    public function providePasswordAndViolationCount()
    {
        return array(
            'At least 8 char' => array('Admin_', 1),
            'At least 1 uppercase' => array('admin_admin', 1),
            'At least 1 lowercase' => array('ADMIN_ADMIN', 1),
            'At least 1 special char' => array('AdminAdmin', 1),
            'Ok' => array('Admin_Admin', 0)
        );
    }
}
