<?php

namespace App\Subscriber\Guest;

use App\Entity\Guest\GuestDetail;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;

/**
 * Class GuestSubscriber
 * @package App\Subscriber\Guest
 */
class GuestSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return
        [
            Events::onFlush
        ];
    }


    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $entities = $uow->getScheduledEntityUpdates();

        foreach ($entities as $entity) {
            if ($entity instanceof GuestDetail) {
                $changes = $uow->getEntityChangeSet($entity);
                if (array_key_exists('type', $changes) && $changes['type'][0] != $changes['type'][1]) {
                    if (isset($changes['image']) && $changes['image'][0]) {
                        $entity->removeImage($changes['image'][0]);
                    }
                }
                if (array_key_exists('image', $changes) && isset($changes['images']) && $changes['image'][0] != $changes['image'][1]) {
                    if ($changes['image'][0]) {
                        $entity->removeImage($changes['image'][0]);
                    }
                }
            }
        }
    }

}
