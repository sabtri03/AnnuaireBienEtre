<?php

namespace App\EventListener;


use App\Entity\Picture;
use App\Entity\Provider;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener {
    use LoggerTrait;
    /**
     * @var FileUploader
     */
    private $uploader;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * ImageUploadListener constructor.
     *
     * @param FileUploader $uploader
     */
    public function __construct( FileUploader $uploader, LoggerInterface $logger ) {
        $this->uploader = $uploader;
        $this->logger = $logger;
    }
    public function prePersist( LifecycleEventArgs $args ) {
        $entity = $args->getEntity();
        $this->uploadFile($entity);
    }
    public function preUpdate( PreUpdateEventArgs $args ) {
        $this->log(Logger::DEBUG, 'in preUpdate');
        $entity = $args->getEntity();

        $previousImage = null;
        // if the entity that we modify is Provider
        if($entity instanceof Provider){
            // we take the change
            $changes = $args->getEntityChangeSet();
            // if there is a change in the field Logo
            if(array_key_exists('logo', $changes)){
                // we take the value before the change
                $previousImage = $changes['logo'][0];
            }
            if(is_null($entity->getLogo())){
                // we put back the previous pict
                $entity->addLogo($previousImage);
            }else{
                // if there is a new picture uploaded
                if(! is_null($previousImage)){
                    $this->uploader->removeFile($previousImage);
                }
            }
        }
        $this->uploadFile($entity);
    }

    private function uploadFile($entity){
        if(!$entity instanceof Picture){
            return;
        }
        $picture = $entity->getPicture();
        $this->log(Logger::DEBUG, "hello Alex");
        $this->log(Logger::DEBUG, $picture);
        if($picture instanceof UploadedFile){
            $this->log(Logger::DEBUG, "debut uploadedFile");
            $filename = $this->uploader->upload($picture);
            $entity->setPicture($filename);
            $entity->setRank(1);  //Can't be null

        }
    }

    public function log( $level, $message, array $context = array() ) {
        $this->logger->log($level, $message, $context);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Picture) {
            return;
        }

        if ($fileName = $entity->getPicture()) {
            $entity->setPicture(new File($this->uploader->getTargetDirectory().'/'.$fileName));
        }
    }
}