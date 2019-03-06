<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     * 
     */
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Upload a specific file
     * 
     * @param UploadFile $file
     * @return string $filename
     */
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);

        } catch (FileException $e) {

            throw new FileException($e);
            return null;
        }

        return $fileName;
    }

    /**
     * Get the target directory
     * 
     * @return string
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}