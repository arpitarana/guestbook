<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User\User;
use App\Service\User\MailManager;

class MailManagerTest extends KernelTestCase
{
    public function testForgotPassword(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $mailManager = self::$container->get(MailManager::class);
        $user = $dm->getRepository(User::class)->findOneByEmail('admin@test.com');

        $data = $mailManager->forgotPassword($user);

        $this->assertSame(true, $data);
    }
    public function testChangePasswordEmail(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $mailManager = self::$container->get(MailManager::class);
        $user = $dm->getRepository(User::class)->findOneByEmail('admin@test.com');

        $data = $mailManager->changePasswordEmail($user);

        $this->assertSame(true, $data);
    }
}
