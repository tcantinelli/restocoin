<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plat", mappedBy="listeMenus")
     */
    private $listePlats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Carte", inversedBy="listeMenus")
     */
    private $listeCartes;

    public function __construct()
    {
        $this->listePlats = new ArrayCollection();
        $this->listeCartes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getListePlats(): Collection
    {
        return $this->listePlats;
    }

    public function addListePlat(Plat $listePlat): self
    {
        if (!$this->listePlats->contains($listePlat)) {
            $this->listePlats[] = $listePlat;
            $listePlat->addListeMenu($this);
        }

        return $this;
    }

    public function removeListePlat(Plat $listePlat): self
    {
        if ($this->listePlats->contains($listePlat)) {
            $this->listePlats->removeElement($listePlat);
            $listePlat->removeListeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection|Carte[]
     */
    public function getListeCartes(): Collection
    {
        return $this->listeCartes;
    }

    public function addListeCarte(Carte $listeCarte): self
    {
        if (!$this->listeCartes->contains($listeCarte)) {
            $this->listeCartes[] = $listeCarte;
        }

        return $this;
    }

    public function removeListeCarte(Carte $listeCarte): self
    {
        if ($this->listeCartes->contains($listeCarte)) {
            $this->listeCartes->removeElement($listeCarte);
        }

        return $this;
    }
}
