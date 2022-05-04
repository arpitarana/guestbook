<?php

namespace App\Repository\Master;

use Doctrine\ORM\EntityRepository;

/**
 * Class RoleRepository
 * @package App\Repository\Master
 */
class RoleRepository extends EntityRepository
{
    /**
     * @return array|false
     */
    public function getRoles()
    {
        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder
            ->select('r.name')
            ;

        $roles = $queryBuilder->getQuery()
            ->getScalarResult();

        return array_column($roles, 'name', 'name');
    }
}
