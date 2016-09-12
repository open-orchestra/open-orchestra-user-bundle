<?php

namespace OpenOrchestra\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ComplexUserPassword
 */
class ComplexUserPassword extends Constraint
{
    public $message = 'open_orchestra_user.form.registration_user.complex_user_password';
}
