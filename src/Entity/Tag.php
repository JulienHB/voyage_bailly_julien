<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Voyage::class, inversedBy="tags")
     */
    private $lien;

    public function __construct()
    {
        $this->lien = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection|Voyage[]
     */
    public function getLien(): Collection
    {
        return $this->lien;
    }

    public function addLien(Voyage $lien): self
    {
        if (!$this->lien->contains($lien)) {
            $this->lien[] = $lien;
        }

        return $this;
    }

    public function removeLien(Voyage $lien): self
    {
        $this->lien->removeElement($lien);

        return $this;
    }
}
