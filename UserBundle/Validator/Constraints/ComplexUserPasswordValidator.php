s<?php

namespace OpenOrchestra\UserBundle\Validator\Constraints;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * Class ComplexUserPasswordValidator
 */
class ComplexUserPasswordValidator extends ConstraintValidator
{

    private $tokenStorage;
    private $encoderFactory;

    /**
     * @param TokenStorageInterface   $tokenStorage
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(TokenStorageInterface $tokenStorage, EncoderFactoryInterface $encoderFactory)
    {
        $this->tokenStorage = $tokenStorage;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param string     $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $newPassword = $this->context->getRoot()->get('plainPassword')->getViewData();
        if ($this->context->getRoot()->has('current_password')) {
            $currentPassword = $this->context->getRoot()->get('current_password')->getData();
            if (strlen($currentPassword) > 0) {
                $user = $this->tokenStorage->getToken()->getUser();
                if (!$user instanceof UserInterface) {
                    throw new ConstraintDefinitionException('The User object must implement the UserInterface interface.');
                }
                $encoder = $this->encoderFactory->getEncoder($user);
                if (!$encoder->isPasswordValid($user->getPassword(), $currentPassword, $user->getSalt())) {
                    $this->context->buildViolation($constraint->messageCurrentPasswordIncorrect)
                    ->atPath('current_password')
                    ->addViolation();
                }
            } elseif (strlen($newPassword['first']) > 0) {
                $this->context->buildViolation($constraint->messageCurrentUserPassword)
                ->atPath('current_password')
                ->addViolation();
            }
        }
        if (strlen($newPassword['first']) > 0) {
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[$@&_#\*\-\+]).{8,}$/', $newPassword['first'])) {
                $this->context->buildViolation($constraint->messageComplexUserPassword)
                ->atPath('plainPassword')
                ->addViolation();
            }
        }
    }
}
