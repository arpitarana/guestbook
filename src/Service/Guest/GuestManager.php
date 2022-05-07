<?php

namespace App\Service\Guest;

use App\Entity\Guest\GuestDetail;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GuestManager
 * @package App\Service\Guest
 */
class GuestManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $role
     * @return GuestDetail[]|array|object[]
     */
    public function getGuestDataByRole($role, User $user, $guestSearch)
    {
        if (in_array($role, $user->getRoles())) {
            $guestData = $this->entityManager->getRepository(GuestDetail::class)->getGuestData($guestSearch);
        }
        else {
            $guestData = $this->entityManager->getRepository(GuestDetail::class)->getGuestData($guestSearch, $user->getId());
        }

        return $guestData;
    }

    /**
     * @param $status
     * @param GuestDetail $guestDetail
     * @return bool
     */
    public function updateStatus($status, GuestDetail $guestDetail)
    {
        $guestDetail->setStatus($status);
        $this->entityManager->flush();
        return true;
    }

    /**
     * @param $type
     * @param User $user
     * @param $guestDetail
     * @return bool
     */
    public function saveGuestData($type, User $user, $guestDetail)
    {
        if ($type == 'image') {
            $guestDetail->setInformation(NULL);
        }
        else {
            $guestDetail->setImage(NULL);
        }
        $guestDetail->setUser($user);
        $this->entityManager->persist($guestDetail);
        $this->entityManager->flush();

        return true;
    }
}
