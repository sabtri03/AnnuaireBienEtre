<?php
namespace App\Services;

use App\Entity\Picture;

use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {
    private $targetDirectory;

    private $fs;
    /**
     * FileUploader constructor.ss
     *
     * @param $targetDirectory
     */
    public function __construct( $targetDirectory, Filesystem $fs) {
        $this->targetDirectory = $targetDirectory;
        $this->fs = $fs;
    }
    public function upload(UploadedFile $file){
        $stream = fopen($file->getRealPath(), 'r+');
        if (false === $stream) throw new UploadException('impossible de copier le fichier');
        $filename = $this->getFilename($file);
        $res = $this->fs->writeStream($filename, $stream);
        if(!$res)throw new UploadException('impossible de copier le fichier');
        fclose($stream);
        return $filename;
    }
    public function removeFile($file){
        if($file instanceof Picture){
            $this->fs->delete($file->getPicture());
        }
    }
    protected function getFilename(UploadedFile $file){
        return sprintf("%s.%s", md5(uniqid()), $file->guessExtension());
    }
    public function getTargetDirectory(){
        return $this->targetDirectory;
    }
}

?>