<?php

namespace App\Repository\Master;

use Doctrine\ORM\EntityRepository;

/**
 * Class PermissionTypeRepository
 * @package App\Repository\Master
 */
class PermissionTypeRepository extends EntityRepository
{
    /**
     * @return array
     * fetch all permission types
     */
    public function fetchAllPermissionTypes()
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $queryBuilder
            ->select('p.name')
        ;

        $status = $queryBuilder->getQuery()
            ->getScalarResult();

        return array_column($status, 'name', 'name');
    }
}
