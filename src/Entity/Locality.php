<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalityRepository")
 */
class Locality
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
    private $locality;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="adresseLocality")
     */
    private $no;

    public function __construct()
    {
        $this->no = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(User $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no[] = $no;
            $no->setAdresseLocality($this);
        }

        return $this;
    }

    public function removeNo(User $no): self
    {
        if ($this->no->contains($no)) {
            $this->no->removeElement($no);
            // set the owning side to null (unless already changed)
            if ($no->getAdresseLocality() === $this) {
                $no->setAdresseLocality(null);
            }
        }

        return $this;
    }
}
