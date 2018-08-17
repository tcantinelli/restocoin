<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypesDePlatsRepository")
 */
class TypesDePlats
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
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plat", mappedBy="type")
     */
    private $listePlats;

    public function __construct()
    {
        $this->listePlats = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

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
            $listePlat->setType($this);
        }

        return $this;
    }

    public function removeListePlat(Plat $listePlat): self
    {
        if ($this->listePlats->contains($listePlat)) {
            $this->listePlats->removeElement($listePlat);
            // set the owning side to null (unless already changed)
            if ($listePlat->getType() === $this) {
                $listePlat->setType(null);
            }
        }

        return $this;
    }
}
