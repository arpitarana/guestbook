<?php

namespace App\Validator\User;

use App\Entity\User\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PasswordConstraintValidator
 * @package App\Validator\User
 */
class PasswordConstraintValidator extends ConstraintValidator
{
    /**
     * @param User $user
     */
    public function validate($user, Constraint $constraint)
    {
        $rawPassword = $user->getRawPassword();
        if (null === $rawPassword || '' === $rawPassword) {
            return;
        }
        if ($constraint->minLength > 0 && (mb_strlen($rawPassword) < $constraint->minLength)) {
            $this->context->addViolation($constraint->tooShortMessage, ['{{length}}' => $constraint->minLength]);
        }
        if ($constraint->requireLetters && !preg_match('/\pL/u', $rawPassword)) {
            $this->context->addViolation($constraint->missingLettersMessage);
        }
        if ($constraint->requireCaseDiff && !preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $rawPassword)) {
            $this->context->addViolation($constraint->requireCaseDiffMessage);
        }
        if ($constraint->requireNumbers && !preg_match('/\pN/u', $rawPassword)) {
            $this->context->addViolation($constraint->missingNumbersMessage);
        }
        if ($constraint->requireSpecialCharacter && !preg_match('/[^p{Ll}\p{Lu}\pL\pN]/u', $rawPassword)) {
            $this->context->addViolation($constraint->missingSpecialCharacterMessage);
        }
    }
}
