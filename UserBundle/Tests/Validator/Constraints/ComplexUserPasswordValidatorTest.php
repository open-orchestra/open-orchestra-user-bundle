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
     * @var ComplexUserPasswordValidator
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
        $this->user = Phake::mock('Symfony\Component\Security\Core\User\UserInterface');
        $this->token = Phake::mock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        $this->tokenStorage = Phake::mock('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface');
        $this->encoder = Phake::mock('Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface');
        $this->encoderFactory = Phake::mock('Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface');

        Phake::when($this->context)->buildViolation(Phake::anyParameters())->thenReturn($this->constraintViolationBuilder);
        Phake::when($this->constraintViolationBuilder)->atPath(Phake::anyParameters())->thenReturn($this->constraintViolationBuilder);
        Phake::when($this->token)->getUser()->thenReturn($this->user);
        Phake::when($this->tokenStorage)->getToken()->thenReturn($this->token);
        Phake::when($this->encoderFactory)->getEncoder(Phake::anyParameters())->thenReturn($this->encoder);

        $this->validator = new ComplexUserPasswordValidator($this->tokenStorage, $this->encoderFactory);
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
    public function testAddViolationOrNot($currentPassword, $password, $isOldPassword, $violationTimes)
    {
        Phake::when($this->encoder)->isPasswordValid(Phake::anyParameters())->thenReturn($isOldPassword);
        $root = Phake::mock('Symfony\Component\Form\FormInterface');
        $currentPasswordFormType = Phake::mock('Symfony\Component\Form\FormInterface');
        $plainPasswordFormType = Phake::mock('Symfony\Component\Form\FormInterface');
        Phake::when($currentPasswordFormType)->getData()->thenReturn($currentPassword);
        Phake::when($plainPasswordFormType)->getViewData()->thenReturn(array(
            'first' =>$password,
            'second' => $password
        ));
        Phake::when($root)->has('current_password')->thenReturn(strlen($currentPassword) > 0);
        Phake::when($root)->get('current_password')->thenReturn($currentPasswordFormType);
        Phake::when($root)->get('plainPassword')->thenReturn($plainPasswordFormType);

        Phake::when($this->context)->getRoot()->thenReturn($root);

        $this->validator->initialize($this->context);

        $this->validator->validate($password, $this->constraint);

        Phake::verify($this->context, Phake::times($violationTimes))->buildViolation(Phake::anyParameters());
    }

    /**
     * @return array
     */
    public function providePasswordAndViolationCount()
    {
        return array(
            'no current password' => array('', 'Admin_', true, 1),
            'bad current password' => array('fakePassword', 'Admin_', false, 2),
            'At least 8 char' => array('fakePassword', 'Admin_', true, 1),
            'At least 1 uppercase' => array('fakePassword', 'admin_admin', true, 1),
            'At least 1 lowercase' => array('fakePassword', 'ADMIN_ADMIN', true, 1),
            'At least 1 special char' => array('fakePassword', 'AdminAdmin', true, 1),
            'Ok' => array('fakePassword', 'Admin_Admin', true, 0)
        );
    }
}
