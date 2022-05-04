<?php

namespace App\Repository\Master;

use Doctrine\ORM\EntityRepository;

/**
 * Class ResourceRepository
 * @package App\Repository\Master
 */
class ResourceRepository extends EntityRepository
{
    /**
     * @return array
     * fetch all resources
     */
    public function fetchAllResources()
    {
        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder
            ->select('r.name')
        ;

        $status = $queryBuilder->getQuery()
            ->getScalarResult();

        return array_column($status, 'name');
    }

    /**
     * @return array
     * fetch all order by Resource
     */
    public function fetchOrderByResources()
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->orderBy('r.name', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }
}
