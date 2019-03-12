<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurferRepository")
 */
class Surfer extends User
{
  /*  /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    //private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $newsletter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Provider")
     */
    private $favorit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Picture", cascade={"persist", "remove"})
     */
    private $avatar;

    public function __construct()
    {
        $this->favorit = new ArrayCollection();
    }

   /* public function getId(): ?int
    {
        return $this->id;
    }
    */
    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Provider[]
     */
    public function getFavorit(): Collection
    {
        return $this->favorit;
    }

    public function addFavorit(Provider $favorit): self
    {
        if (!$this->favorit->contains($favorit)) {
            $this->favorit[] = $favorit;
        }

        return $this;
    }

    public function removeFavorit(Provider $favorit): self
    {
        if ($this->favorit->contains($favorit)) {
            $this->favorit->removeElement($favorit);
        }

        return $this;
    }

    public function getAvatar(): ?Picture
    {
        return $this->avatar;
    }

    public function setAvatar(?Picture $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
