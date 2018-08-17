<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 */
class Carte
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
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $online;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Menu", mappedBy="listeCartes")
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

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
            $listeMenu->addListeCarte($this);
        }

        return $this;
    }

    public function removeListeMenu(Menu $listeMenu): self
    {
        if ($this->listeMenus->contains($listeMenu)) {
            $this->listeMenus->removeElement($listeMenu);
            $listeMenu->removeListeCarte($this);
        }

        return $this;
    }
}
