<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User\User;
use App\Service\User\UserManager;


class UserManagerTest extends KernelTestCase
{
    public function testManageUpdatedPassword(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $userManager = self::$container->get(UserManager::class);
        $user = $dm->getRepository(User::class)->findOneByEmail('admin@test.com');

        $data = $userManager->manageUpdatedPassword($user, 'admin');
        $this->assertSame(true, $data);

        $user = new User();
        $data = $userManager->manageUpdatedPassword($user, 'admin');
        $this->assertSame(false, $data);
    }
    public function testSaveUser(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $userManager = self::$container->get(UserManager::class);

        $user = new User();
        $username = 'test_'.uniqid();
        $user->setFirstName('test');
        $user->setLastName('test');
        $user->setUsername($username);
        $user->setEmail($username.'@test.com');
        $user->setPassword('test@123');
        $data = $userManager->saveUser($user);
        //Save user success
        $this->assertSame(true, $data);


        $user = new User();
        $data = $userManager->saveUser($user);
        //Save user failure
        $this->assertSame(false, $data);
    }
}
