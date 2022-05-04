<?php

namespace App\Entity\Master;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ResourcePermission
 * @package App\Entity\Master
 */
class ResourcePermission
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var \App\Entity\Master\Resource
     */
    public $resource;

    /**
     * @var \App\Entity\Master\PermissionType
     */
    public $permissionType;

    /**
     * @var string
     */
    public $permissionMatrices;

    public function __construct()
    {
        $this->permissionMatrices = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add permissionMatrix
     *
     * @param \App\Entity\Master\PermissionMatrix $permissionMatrix
     *
     * @return ResourcePermission
     */
    public function addPermissionMatrix(\App\Entity\Master\PermissionMatrix $permissionMatrix)
    {
        $this->permissionMatrices[] = $permissionMatrix;

        return $this;
    }

    /**
     * Remove permissionMatrix
     *
     * @param \App\Entity\Master\PermissionMatrix $permissionMatrix
     */
    public function removePermissionMatrix(\App\Entity\Master\PermissionMatrix $permissionMatrix)
    {
        $this->permissionMatrices->removeElement($permissionMatrix);
    }

    /**
     * Get permissionMatrices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermissionMatrices()
    {
        return $this->permissionMatrices;
    }

    /**
     * Set resource
     *
     * @param \App\Entity\Master\Resource $resource
     *
     * @return ResourcePermission
     */
    public function setResource(\App\Entity\Master\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \App\Entity\Master\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set permissionType
     *
     * @param \App\Entity\Master\PermissionType $permissionType
     *
     * @return ResourcePermission
     */
    public function setPermissionType(\App\Entity\Master\PermissionType $permissionType = null)
    {
        $this->permissionType = $permissionType;

        return $this;
    }

    /**
     * Get permissionType
     *
     * @return \App\Entity\Master\PermissionType
     */
    public function getPermissionType()
    {
        return $this->permissionType;
    }
}
