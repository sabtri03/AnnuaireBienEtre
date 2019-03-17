<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="logo")
     */
    private $logo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture() //: ?string
    {
        return $this->picture;
    }

    public function setPicture( $picture): self //?string
    {
        $this->picture = $picture;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getLogo(): ?Provider
    {
        return $this->logo;
    }

    public function setLogo(?Provider $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
