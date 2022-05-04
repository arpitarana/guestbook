<?php

namespace App\Service\Guest;

use App\Entity\Guest\GuestDetail;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Master\FileUploader;

/**
 * Class GuestManager
 * @package App\Service\Guest
 */
class GuestManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var FileUploader */
    private $fileUploader;

    public function __construct(
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader
    ) {
        $this->entityManager = $entityManager;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param $role
     * @return GuestDetail[]|array|object[]
     */
    public function getGuestDataByRole($role, User $user)
    {
        if (in_array($role, $user->getRoles())) {
            $guestData = $this->entityManager->getRepository(GuestDetail::class)->findAll();
        }
        else {
            $guestData = $this->entityManager->getRepository(GuestDetail::class)->getGuestData($user->getId());
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
     * @param $imageFile
     * @param User $user
     * @param $guestDetail
     * @return bool
     */
    public function saveGuestData($type, $imageFile, User $user, $guestDetail)
    {
        if ($type == 'image') {
            if ($imageFile) {
                $filePath = GuestDetail::$imageFilePath;
                $profilePic = $this->fileUploader->uploadImage($imageFile, $filePath);
                $guestDetail->setImage($profilePic);
            }
        }
        $guestDetail->setUser($user);
        $this->entityManager->persist($guestDetail);
        $this->entityManager->flush();

        return true;
    }
}
