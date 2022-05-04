<?php
namespace App\Security;

use App\Entity\Guest\GuestDetail;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class GuestVoter extends Voter
{
    const OWN_GUEST = 'own_guest';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::OWN_GUEST])) {
            return false;
        }

        // only vote on Ticket objects inside this voter
        if (!$subject instanceof GuestDetail) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getuser();

        if (!$user instanceof user) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($subject->getstatus() != guestdetail::PENDING_STATUS) {
            return false;
        }

        if ($user->getid() == $subject->getuser()->getId()) {
            return true;
        }

        return false;
    }
}