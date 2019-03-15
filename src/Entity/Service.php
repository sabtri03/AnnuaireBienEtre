<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inFront;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Provider", inversedBy="category")
     */
    private $Propose;

    public function __construct()
    {
        $this->Propose = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInFront(): ?bool
    {
        return $this->inFront;
    }

    public function setInFront(?bool $inFront): self
    {
        $this->inFront = $inFront;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValidity(): ?bool
    {
        return $this->validity;
    }

    public function setValidity(?bool $validity): self
    {
        $this->validity = $validity;

        return $this;
    }

    /**
     * @return Collection|Provider[]
     */
    public function getPropose(): Collection
    {
        return $this->Propose;
    }

    public function addPropose(Provider $propose): self
    {
        if (!$this->Propose->contains($propose)) {
            $this->Propose[] = $propose;
        }

        return $this;
    }

    public function removePropose(Provider $propose): self
    {
        if ($this->Propose->contains($propose)) {
            $this->Propose->removeElement($propose);
        }

        return $this;
    }
}
