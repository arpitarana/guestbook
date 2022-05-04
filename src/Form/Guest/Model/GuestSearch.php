<?php

namespace App\Form\Guest\Model;

/**
 * Class GuestSearch
 * @package App\Form\Guest\Model
 */
class GuestSearch
{
    /** @var  string */
    public $name;

    /** @var  integer */
    public $status;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
