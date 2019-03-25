<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 */
class Provider extends User
{
   /* /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
   /*
    private $id;
   */

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tvaNumb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Internship", mappedBy="organizer")
     */
    private $internships;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", mappedBy="propose",cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="logo", cascade={"persist", "remove"})
     */
    private $logo;


    public function __construct()
    {
        $this->internships = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->logo = new ArrayCollection();
    }
/*
    public function getId(): ?int
    {
        return $this->id;
    }
*/

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneNumb(): ?string
    {
        return $this->phoneNumb;
    }

    public function setPhoneNumb(?string $phoneNumb): self
    {
        $this->phoneNumb = $phoneNumb;

        return $this;
    }

    public function getTvaNumb(): ?string
    {
        return $this->tvaNumb;
    }

    public function setTvaNumb(?string $tvaNumb): self
    {
        $this->tvaNumb = $tvaNumb;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }


    /**
     * @return Collection|Internship[]
     */
    public function getInternships(): Collection
    {
        return $this->internships;
    }

    public function addInternship(Internship $internship): self
    {
        if (!$this->internships->contains($internship)) {
            $this->internships[] = $internship;
            $internship->setOrganizer($this);
        }

        return $this;
    }

    public function removeInternship(Internship $internship): self
    {
        if ($this->internships->contains($internship)) {
            $this->internships->removeElement($internship);
            // set the owning side to null (unless already changed)
            if ($internship->getOrganizer() === $this) {
                $internship->setOrganizer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Service $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->addPropose($this);
        }

        return $this;
    }

    public function removeCategory(Service $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
            $category->removePropose($this);
        }

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Picture $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo[] = $logo;
            $logo->setLogo($this);
        }

        return $this;
    }

    public function removeLogo(Picture $logo): self
    {
        if ($this->logo->contains($logo)) {
            $this->logo->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getLogo() === $this) {
                $logo->setLogo(null);
            }
        }

        return $this;
    }



}
