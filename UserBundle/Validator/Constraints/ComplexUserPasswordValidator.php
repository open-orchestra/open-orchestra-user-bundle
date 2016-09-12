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
        if (strlen($value) < 8
            || !preg_match('/[A-Z]/', $value)
            || !preg_match('/[a-z]/', $value)
            || !preg_match('/[$@&_#\*\-\+]/', $value)
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
