<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SoireRepository")
 */
class Soire
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
     * @ORM\Column(type="float")
     */
    private $Tarif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Place;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Soire")
     */

    private $resevations;

    public function __construct()
    {
        $this->resevations = new ArrayCollection();
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

    public function getTarif(): ?float
    {
        return $this->Tarif;
    }

    public function setTarif(float $Tarif): self
    {
        $this->Tarif = $Tarif;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResevations()
    {
        return $this->resevations;
    }

    /**
     * @param mixed $resevations
     */
    public function addResevations($resevation): void
    {
        $this->resevations[] = $resevation;
    }

    /**
     * @param mixed $resevations
     */
    public function removeResevations($resevation): void
    {
        $this->resevations->remove($resevation);
    }

    public function addResevation(Reservation $resevation): self
    {
        if (!$this->resevations->contains($resevation)) {
            $this->resevations[] = $resevation;
            $resevation->setSoire($this);
        }

        return $this;
    }

    public function removeResevation(Reservation $resevation): self
    {
        if ($this->resevations->contains($resevation)) {
            $this->resevations->removeElement($resevation);
            // set the owning side to null (unless already changed)
            if ($resevation->getSoire() === $this) {
                $resevation->setSoire(null);
            }
        }

        return $this;
    }
}
