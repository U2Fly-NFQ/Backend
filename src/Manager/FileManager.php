<?php

namespace App\Manager;

use Aws\S3\S3Client;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileManager
{
    private string $targetDir;
    private string $s3BucketName;
    private S3Client $s3Client;
    private SluggerInterface $slugger;
    private ContainerBagInterface $containerBag;

    public function __construct(
            $targetDirectory,
            $bucketName,
            S3Client $s3Client,
            SluggerInterface $slugger,
            ContainerBagInterface $containerBag
    )
    {
        $this->targetDirectory = $targetDirectory;
        $this->bucketName = $bucketName;
        $this->s3Client = $s3Client;
        $this->slugger = $slugger;
        $this->containerBag = $containerBag;
    }

    public function localUpload(UploadedFile $file)
    {
        $imageName = $this->getImageName($file);
    }
}
