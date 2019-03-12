<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $showDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $showUntil;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $begin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $docPDF;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShowDate(): ?\DateTimeInterface
    {
        return $this->showDate;
    }

    public function setShowDate(?\DateTimeInterface $showDate): self
    {
        $this->showDate = $showDate;

        return $this;
    }

    public function getShowUntil(): ?\DateTimeInterface
    {
        return $this->showUntil;
    }

    public function setShowUntil(?\DateTimeInterface $showUntil): self
    {
        $this->showUntil = $showUntil;

        return $this;
    }

    public function getBegin(): ?\DateTimeInterface
    {
        return $this->begin;
    }

    public function setBegin(?\DateTimeInterface $begin): self
    {
        $this->begin = $begin;

        return $this;
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

    public function getDocPDF(): ?string
    {
        return $this->docPDF;
    }

    public function setDocPDF(?string $docPDF): self
    {
        $this->docPDF = $docPDF;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

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

    public function getOffer(): ?Provider
    {
        return $this->offer;
    }

    public function setOffer(?Provider $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getCategory(): ?Service
    {
        return $this->category;
    }

    public function setCategory(?Service $category): self
    {
        $this->category = $category;

        return $this;
    }
}
