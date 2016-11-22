<?php

namespace OpenOrchestra\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ComplexUserPassword
 */
class ComplexUserPassword extends Constraint
{
    public $messageComplexUserPassword = 'open_orchestra_user.form.registration_user.complex_user_password';
    public $messageCurrentPasswordNeeded = 'open_orchestra_user.form.registration_user.current_password_needed';
    public $messageCurrentPasswordIncorrect = 'open_orchestra_user.form.registration_user.current_password_incorrect';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'complex_user_password';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
