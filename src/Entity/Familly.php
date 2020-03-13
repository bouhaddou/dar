<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamillyRepository")
 */
class Familly
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
     * @ORM\Column(type="date")
     */
    private $setAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orphelin", mappedBy="familly")
     */
    private $orphelin;

    public function __construct()
    {
        $this->orphelin = new ArrayCollection();
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

    public function getSetAt(): ?\DateTimeInterface
    {
        return $this->setAt;
    }

    public function setSetAt(\DateTimeInterface $setAt): self
    {
        $this->setAt = $setAt;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

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
     * @return Collection|Orphelin[]
     */
    public function getOrphelin(): Collection
    {
        return $this->orphelin;
    }

    public function addOrphelin(Orphelin $orphelin): self
    {
        if (!$this->orphelin->contains($orphelin)) {
            $this->orphelin[] = $orphelin;
            $orphelin->setFamilly($this);
        }

        return $this;
    }

    public function removeOrphelin(Orphelin $orphelin): self
    {
        if ($this->orphelin->contains($orphelin)) {
            $this->orphelin->removeElement($orphelin);
            // set the owning side to null (unless already changed)
            if ($orphelin->getFamilly() === $this) {
                $orphelin->setFamilly(null);
            }
        }

        return $this;
    }
}
