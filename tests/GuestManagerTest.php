<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User\User;
use App\Service\Guest\GuestManager;
use App\Form\Guest\Model\GuestSearch;
use App\Entity\Guest\GuestDetail;

class GuestManagerTest extends KernelTestCase
{
    public function testGetGuestDataByRole(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $guestManager = self::$container->get(GuestManager::class);
        $user = new User();
        $guestSearch = new GuestSearch();

        $query = $guestManager->getGuestDataByRole(User::ROLE_ADMIN, $user, $guestSearch);
        $data = $query->getArrayResult();
        $this->assertSame(true, is_array($data));

        $user = $dm->getRepository(User::class)->findOneByEmail('admin@test.com');
        $query = $guestManager->getGuestDataByRole(User::ROLE_ADMIN, $user, $guestSearch);
        $data = $query->getArrayResult();
        $this->assertSame(true, is_array($data));
    }
    public function testSaveGuestData(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $guestManager = self::$container->get(GuestManager::class);
        $user = $dm->getRepository(User::class)->findOneByEmail('admin@test.com');
        $guestDetail = new GuestDetail();
        $guestDetail->setName('Guest Test');
        $guestDetail->setType('text');
        $guestDetail->setInformation('Guest information');

        //save with type text
        $data = $guestManager->saveGuestData('text', $user, $guestDetail);
        $this->assertSame(true, $data);

        $pathIncludingFilename = __DIR__.'/../assets/images/favicon.png';
        $pathIncludingFilenameCopy = __DIR__.'/../assets/images/favicon1.png';
        copy($pathIncludingFilename, $pathIncludingFilenameCopy);
//        $fileName = 'favicon.png';

//        $file = new UploadedFile(
//            $pathIncludingFilenameCopy,
//            $fileName,
//            'image/png',
//            null,
//            false
//        );
        //save with type image
        $guestDetail->setType('image');
        $data = $guestManager->saveGuestData('image', $user, $guestDetail);
        $this->assertSame(true, $data);
    }
    public function testUpdateStatus(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $dm = self::$container->get('doctrine')->getManager();
        $guestManager = self::$container->get(GuestManager::class);
        $guestDetail = $dm->getRepository(GuestDetail::class)->findOneByName('Guest Test');

        //set status approve
        $data = $guestManager->updateStatus(GuestDetail::APPROVE_STATUS, $guestDetail);
        $this->assertSame(true, $data);

        //set status approve
        $data = $guestManager->updateStatus(GuestDetail::DISAPPROVE_STATUS, $guestDetail);
        $this->assertSame(true, $data);
    }
}
