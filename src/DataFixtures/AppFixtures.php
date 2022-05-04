<?php

namespace App\DataFixtures;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@test.com'); // we can use company's standard email.
        $user->setFirstName('Admin');
        $user->setLastName('Best');
        $user->setRoles(['ROLE_ADMIN']);
        $password = 'admin'; // we can send an email too but I gave here static to run application easily for interviewer with read me after quickly run fixture.
        $user->setRawPassword($password);
        $defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
        $encoders = [
            User::class => $defaultEncoder,
        ];
        $encoderFactory = new EncoderFactory($encoders);
        $encoder = $encoderFactory->getEncoder($user);
        $user->encodePassword($encoder);

        $manager->persist($user);
        $manager->flush();
    }
}
