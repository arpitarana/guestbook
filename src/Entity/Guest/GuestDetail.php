<?php

namespace App\Entity\Guest;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * GuestDetail
 */
class GuestDetail
{
    public static $imageFilePath = 'uploads/image';

    const APPROVE_STATUS = 1;
    const DISAPPROVE_STATUS = -1;
    const PENDING_STATUS = 0;

    const PAGE_RANGE = 10;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \App\Entity\User\User
     */
    protected $user;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $information;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    public $imageFile;

    /**
     * @var int
     */
    protected $status = false;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return GuestDetail
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \App\Entity\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \App\Entity\User\User $user
     *
     * @return GuestDetail
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return GuestDetail
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param string $information
     *
     * @return GuestDetail
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return GuestDetail
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GuestDetail
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return GuestDetail
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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

    // Temporary store the file name
    private $tempFilename;

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(UploadedFile $file = null)
    {
        $this->imageFile = $file;
        $this->extension = $this->imageFile->guessExtension();
        // Replacing a file ? Check if we already have a file for this entity
        if (null !== $this->extension) {
            // Save file extension so we can remove it later
            $this->tempFilename = $this->extension;
            // Reset values
            $this->extension = null;
            $this->image = null;
        }
        $this->preUpload();
    }

    public function preUpload()
    {
        // If no file is set, do nothing
        if (null === $this->imageFile) {
            return;
        }

        // The file name is the entity's ID
        // We also need to store the file extension
        $this->extension = $this->imageFile->guessExtension();

        // And we keep the original name
        //$this->attachment = $this->file->getClientOriginalName();

        $filename = sha1(uniqid(mt_rand(), true));
        $this->image = $filename . '.' . $this->getImageFile()->guessExtension();
    }

    public function upload()
    {
        // If no file is set, do nothing
        if (null === $this->imageFile) {
            return;
        }

        // A file is present, remove it
        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->image;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // Move the file to the upload folder
        $this->imageFile->move(
            $this->getUploadRootDir(),
            $this->image
        );
    }

    public function preRemoveUpload()
    {
        if($this->getImage()) {
            // Save the name of the file we would want to remove
            $this->tempFilename = $this->getUploadRootDir() . '/' . $this->getImage();
        }
    }

    public function removeUpload()
    {
        // PostRemove => We no longer have the entity's ID => Use the name we saved
        if ($this->tempFilename && file_exists($this->tempFilename)) {
            // Remove file
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        // Upload directory
        return self::$imageFilePath;
    }

    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../public/' . $this->getUploadDir();
    }

    public function removeImage($fileName)
    {
        $imageFile = $this->getUploadRootDir() . '/' .$fileName;
        if (file_exists($imageFile)) {
            // Remove file
            unlink($imageFile);
        }
    }
}