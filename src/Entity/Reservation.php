<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbrePlace;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreation;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\VaoyageOrganise", inversedBy="resevations")
     */

    private $VaoyageOrganise;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\Soire", inversedBy="resevations")
     */

    private $Soire;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="resevations")
     */

    private $user;

    public function __construct() {

        $this->DateCreation = new \Datetime();
}

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getNbrePlace(): ?int
    {
        return $this->NbrePlace;
    }

    public function setNbrePlace(int $NbrePlace): self
    {
        $this->NbrePlace = $NbrePlace;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getVaoyageOrganise(): ?VaoyageOrganise
    {
        return $this->VaoyageOrganise;
    }

    public function setVaoyageOrganise(?VaoyageOrganise $VaoyageOrganise): self
    {
        $this->VaoyageOrganise = $VaoyageOrganise;

        return $this;
    }

    public function getSoire(): ?Soire
    {
        return $this->Soire;
    }

    public function setSoire(?Soire $Soire): self
    {
        $this->Soire = $Soire;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
