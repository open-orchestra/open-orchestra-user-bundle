<?php

namespace OpenOrchestra\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ComplexUserPasswordValidator
 */
class ComplexUserPasswordValidator extends ConstraintValidator
{
    /**
     * @param string     $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[$@&_#\*\-\+]).{8,}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
