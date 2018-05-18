<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $Nom;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;




    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="user")
     */

    private $resevations;

    public function __construct()
    {
        $this->resevations = new ArrayCollection();
        parent::__construct();
        // your own logic
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




    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
            $resevation->setUser($this);
        }

        return $this;
    }

    public function removeResevation(Reservation $resevation): self
    {
        if ($this->resevations->contains($resevation)) {
            $this->resevations->removeElement($resevation);
            // set the owning side to null (unless already changed)
            if ($resevation->getUser() === $this) {
                $resevation->setUser(null);
            }
        }

        return $this;
    }


}
