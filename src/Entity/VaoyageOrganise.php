<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VaoyageOrganiseRepository")
 */
class VaoyageOrganise
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
    private $DateDepart;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbreJour;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image()
     */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Programme;
    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="VaoyageOrganise", cascade={"persist"})
     */

    private $images;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="VaoyageOrganise")
     */

    private $resevations;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="App\Entity\Ville", mappedBy="vaoyageOrganises")
     */

    private $villes;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->resevations = new ArrayCollection();
        $this->villes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->DateDepart;
    }

    public function setDateDepart(\DateTimeInterface $DateDepart): self
    {
        $this->DateDepart = $DateDepart;

        return $this;
    }

    public function getNbreJour(): ?int
    {
        return $this->NbreJour;
    }

    public function setNbreJour(int $NbreJour): self
    {
        $this->NbreJour = $NbreJour;

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

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

 public function getCover()
    {
        return $this->cover;
    }

    public function setCover( $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->Programme;
    }

    public function setProgramme(string $Programme): self
    {
        $this->Programme = $Programme;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function addImages($images): void
    {
        $this->images[] = $images;
    }

    /**
     * @param mixed $images
     */
    public function removeImages($image): void
    {
        $this->images->remove($image);
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

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVaoyageOrganise($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getVaoyageOrganise() === $this) {
                $image->setVaoyageOrganise(null);
            }
        }

        return $this;
    }

    public function addResevation(Reservation $resevation): self
    {
        if (!$this->resevations->contains($resevation)) {
            $this->resevations[] = $resevation;
            $resevation->setVaoyageOrganise($this);
        }

        return $this;
    }

    public function removeResevation(Reservation $resevation): self
    {
        if ($this->resevations->contains($resevation)) {
            $this->resevations->removeElement($resevation);
            // set the owning side to null (unless already changed)
            if ($resevation->getVaoyageOrganise() === $this) {
                $resevation->setVaoyageOrganise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->addVaoyageOrganise($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->contains($ville)) {
            $this->villes->removeElement($ville);
            $ville->removeVaoyageOrganise($this);
        }

        return $this;
    }


}
