<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbusRepository")
 */
class Abus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $encoding;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment")
     */
    private $about;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Surfer")
     */
    private $informer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEncoding(): ?\DateTimeInterface
    {
        return $this->encoding;
    }

    public function setEncoding(?\DateTimeInterface $encoding): self
    {
        $this->encoding = $encoding;

        return $this;
    }

    public function getAbout(): ?Comment
    {
        return $this->about;
    }

    public function setAbout(?Comment $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getInformer(): ?Surfer
    {
        return $this->informer;
    }

    public function setInformer(?Surfer $informer): self
    {
        $this->informer = $informer;

        return $this;
    }
}
