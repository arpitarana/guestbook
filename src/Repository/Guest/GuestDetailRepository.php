<?php

namespace App\Repository\Guest;

use Doctrine\ORM\EntityRepository;

/**
 * GuestDetailRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GuestDetailRepository extends EntityRepository
{
    /**
     * @param int $userId
     * @return int|mixed|string
     */
    public function getGuestData($userId = null)
    {
        $qb = $this->createQueryBuilder('g');
        $qb->select('g');
        if ($userId) {
            $qb->where('g.user = :userId')
                ->setParameter('userId', $userId);
        }
        $qb->orderBy('g.id', 'DESC');
        return $qb->getQuery();
    }
}
