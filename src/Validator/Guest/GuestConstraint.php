<?php

namespace App\Validator\Guest;

use App\Entity\User\User;
use Symfony\Component\Validator\Constraint;

/**
 * Class GuestConstraint
 * @package App\Validator\Guest
 */
class GuestConstraint extends Constraint
{
    public $guestInformationRequired = 'Please enter guest information.';
    public $imageRequired = 'Please upload image.';

    public function validatedBy()
    {
        return 'guest_constraint';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
