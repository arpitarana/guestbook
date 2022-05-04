<?php

namespace App\Service\Master;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class FileUploader
 * @package App\Service\Master
 */
class FileUploader
{
    /**
     * @param UploadedFile $file
     * @param $filePath
     * @return string
     */
    public function uploadImage(UploadedFile $file, $filePath)
    {
        $originalFileName = md5(uniqid()) . '.' . $file->guessExtension();
        // Move the file to the directory where profilePic are stored
        try {
            $file->move(
                getcwd() . '/' . $filePath,
                $originalFileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $originalFileName;
    }
}
