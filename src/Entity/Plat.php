<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatRepository")
 */
class Plat
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypesDePlats", inversedBy="listePlats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Menu", inversedBy="listePlats")
     */
    private $listeMenus;

    public function __construct()
    {
        $this->listeMenus = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?TypesDePlats
    {
        return $this->type;
    }

    public function setType(?TypesDePlats $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getListeMenus(): Collection
    {
        return $this->listeMenus;
    }

    public function addListeMenu(Menu $listeMenu): self
    {
        if (!$this->listeMenus->contains($listeMenu)) {
            $this->listeMenus[] = $listeMenu;
        }

        return $this;
    }

    public function removeListeMenu(Menu $listeMenu): self
    {
        if ($this->listeMenus->contains($listeMenu)) {
            $this->listeMenus->removeElement($listeMenu);
        }

        return $this;
    }
}
