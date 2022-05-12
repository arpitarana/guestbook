<?php

namespace App\Validator\Guest;

use App\Entity\Guest\GuestDetail;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class GuestConstraintValidator
 * @package App\Validator\Guest
 */
class GuestConstraintValidator extends ConstraintValidator
{
    /**
     * @param GuestDetail $guestDetail
     */
    public function validate($guestDetail, Constraint $constraint)
    {
        $type = $guestDetail->getType();
        if ($type === '') {
            return;
        }
        if ($type == 'text' && $guestDetail->getInformation() == '') {
            $this->context->buildViolation($constraint->guestInformationRequired)
                ->atPath('information')
                ->addViolation();
        }

        if ($guestDetail->getId() == null && $type == 'image' && $guestDetail->getImageFile() == '') {
            $this->context->buildViolation($constraint->imageRequired)
                ->atPath('imageFile')
                ->addViolation();
        }

    }
}
