<?php

namespace App\Service\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class UserManager
 * @package App\Managers\User
 */
class UserManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var  EncoderFactoryInterface */
    private $encoderFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param User $user
     * @param $password
     * @return bool
     */
    public function manageUpdatedPassword(User $user, $password)
    {
        try {
            $encoder = $this->encoderFactory->getEncoder($user);
            $user->encodePassword($encoder);
            $user->setRawPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        }
        catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function saveUser(User $user)
    {
        try{
            $password = $user->getPassword();
            $user->setRawPassword($password);
            $encoder = $this->encoderFactory->getEncoder($user);
            $user->encodePassword($encoder);

            $user->setSalt($user->getSalt());
            $user->setRoles(['ROLE_GUEST']);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }
}
