<?php

namespace App\Manager;

use Aws\Result;
use Aws\S3\S3Client;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileManager
{
    private string $targetDirectory;
    private string $bucketName;
    private S3Client $s3Client;
    private SluggerInterface $slugger;
    private ContainerBagInterface $params;

    public function __construct($targetDirectory, $bucketName, S3Client $s3Client, SluggerInterface $slugger, ContainerBagInterface $params)
    {
        $this->targetDirectory = $targetDirectory;
        $this->bucketName = $bucketName;
        $this->s3Client = $s3Client;
        $this->slugger = $slugger;
        $this->params = $params;
    }

    public function upload(UploadedFile $file): string
    {
        $s3Path = $this->params->get('s3Url');
        $imageName = $this->getImageName($file);
        $file->move($this->targetDirectory, $imageName);
        $imagePath = $this->targetDirectory . $imageName;
        $imageUpload = $this->s3Upload($imageName, $imagePath);
        unlink($imagePath);
        $s3Path = $imageUpload->get('ObjectURL');
        return $this->getRelativelyPath($s3Path);
    }

    private function getImageName(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        return $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    }

    private function getRelativelyPath(string $fullPath): string
    {
        $s3Path = $this->params->get('s3Url');
        return substr($fullPath, strlen($s3Path));
    }

    private function s3Upload(string $imageName, string $imagePath): Result
    {
        return $this->s3Client->putObject(
            [
                'Bucket' => $this->bucketName,
                'Key' => 'car/' . $imageName,
                'SourceFile' => $imagePath,
            ]
        );
    }
}
