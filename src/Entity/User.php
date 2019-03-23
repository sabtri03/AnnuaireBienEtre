<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "surfer" = "Surfer", "provider" = "Provider"})
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface  //abstract
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseNum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseStreet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $banned;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inscrActivated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $inscriDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $unsucessfulTry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PostalCode", cascade={"persist"})
     */
    private $adresseCP;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality", inversedBy="no", cascade={"persist"})
     */
    private $adresseLocality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", cascade={"persist"})
     */
    private $adresseCity;




    public function getId(): ?int
    {
        return $this->id;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles)  //: self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAdresseNum(): ?string
    {
        return $this->adresseNum;
    }

    public function setAdresseNum(?string $adresseNum): self
    {
        $this->adresseNum = $adresseNum;

        return $this;
    }

    public function getAdresseStreet(): ?string
    {
        return $this->adresseStreet;
    }

    public function setAdresseStreet(?string $adresseStreet): self
    {
        $this->adresseStreet = $adresseStreet;

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(?bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getIdentifiant(): ?int
    {
        return $this->identifiant;
    }

    public function setIdentifiant(?int $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getInscrActivated(): ?bool
    {
        return $this->inscrActivated;
    }

    public function setInscrActivated(?bool $inscrActivated): self
    {
        $this->inscrActivated = $inscrActivated;

        return $this;
    }

    public function getInscriDate(): ?\DateTimeInterface
    {
        return $this->inscriDate;
    }

    public function setInscriDate(?\DateTimeInterface $inscriDate): self
    {
        $this->inscriDate = $inscriDate;

        return $this;
    }

    public function getUnsucessfulTry(): ?bool
    {
        return $this->unsucessfulTry;
    }

    public function setUnsucessfulTry(?bool $unsucessfulTry): self
    {
        $this->unsucessfulTry = $unsucessfulTry;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(?string $userType): self
    {
        $this->userType = $userType;

        return $this;
    }

    public function getAdresseCP(): ?PostalCode
    {
        return $this->adresseCP;
    }

    public function setAdresseCP(?PostalCode $adresseCP): self
    {
        $this->adresseCP = $adresseCP;

        return $this;
    }

    public function getAdresseLocality(): ?Locality
    {
        return $this->adresseLocality;
    }

    public function setAdresseLocality(?Locality $adresseLocality): self
    {
        $this->adresseLocality = $adresseLocality;

        return $this;
    }

    public function getAdresseCity(): ?City
    {
        return $this->adresseCity;
    }

    public function setAdresseCity(?City $adresseCity): self
    {
        $this->adresseCity = $adresseCity;

        return $this;
    }



}
