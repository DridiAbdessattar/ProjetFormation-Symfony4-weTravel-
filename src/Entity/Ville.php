<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pays;


    /**
     * @var
     * @ORM\ManyToMany(targetEntity="App\Entity\VaoyageOrganise", inversedBy="villes")
     */

    private $vaoyageOrganises;

    public function __construct()
    {
        $this->vaoyageOrganises = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVaoyageOrganises()
    {
        return $this->vaoyageOrganises;
    }

    /**
     * @param mixed $vaoyageOrganises
     */
    public function addVaoyageOrganises($vaoyageOrganise): void
    {
        $this->vaoyageOrganises[] = $vaoyageOrganise;
    }

    /**
     * @param mixed $vaoyageOrganises
     */
    public function setVaoyageOrganises($vaoyageOrganise): void
    {
        $this->vaoyageOrganises->remove($vaoyageOrganise);
    }

    public function addVaoyageOrganise(VaoyageOrganise $vaoyageOrganise): self
    {
        if (!$this->vaoyageOrganises->contains($vaoyageOrganise)) {
            $this->vaoyageOrganises[] = $vaoyageOrganise;
        }

        return $this;
    }

    public function removeVaoyageOrganise(VaoyageOrganise $vaoyageOrganise): self
    {
        if ($this->vaoyageOrganises->contains($vaoyageOrganise)) {
            $this->vaoyageOrganises->removeElement($vaoyageOrganise);
        }

        return $this;
    }
}
