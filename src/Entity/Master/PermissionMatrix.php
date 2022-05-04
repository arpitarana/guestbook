<?php

namespace App\Entity\Master;

/**
 * PermissionMatrix
 */
class PermissionMatrix
{
    /**
     * @var int
     */
    protected $id;


    /**
     * @var \App\Entity\Master\Role
     */
    protected $role;

    /**
     * @var \App\Entity\Master\Resource
     */
    protected $resourcePermission;

    /**
     * @var bool
     */
    protected $granted;

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
     * Set granted
     *
     * @param boolean $granted
     *
     * @return PermissionMatrix
     */
    public function setGranted($granted)
    {
        $this->granted = $granted;

        return $this;
    }

    /**
     * Get granted
     *
     * @return boolean
     */
    public function getGranted()
    {
        return $this->granted;
    }

    /**
     * Set role
     *
     * @param \App\Entity\Master\Role $role
     *
     * @return PermissionMatrix
     */
    public function setRole(\App\Entity\Master\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \App\Entity\Master\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set resourcePermission
     *
     * @param \App\Entity\Master\ResourcePermission $resourcePermission
     *
     * @return PermissionMatrix
     */
    public function setResourcePermission(\App\Entity\Master\ResourcePermission $resourcePermission = null)
    {
        $this->resourcePermission = $resourcePermission;

        return $this;
    }

    /**
     * Get resourcePermission
     *
     * @return \App\Entity\Master\ResourcePermission
     */
    public function getResourcePermission()
    {
        return $this->resourcePermission;
    }
}
