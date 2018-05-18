<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $url;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\VaoyageOrganise", inversedBy="images")
     */

    private $VaoyageOrganise;

    public function getId()
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
}
