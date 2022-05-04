<?php

namespace App\Entity\Master;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Role
 * @package App\Entity\Master
 */
class Role
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $permissionMatrices;

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
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add permissionMatrix
     *
     * @param \App\Entity\Master\PermissionMatrix $permissionMatrix
     *
     * @return Role
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
}
