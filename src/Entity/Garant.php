<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GarantRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Garant
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
    private $Name;

   
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paye;

 

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Kafala", mappedBy="garant")
     */
    private $kafalas;

    public function __construct()
    {
        $this->kafalas = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }



    public function getPaye(): ?string
    {
        return $this->paye;
    }

    public function setPaye(string $paye): self
    {
        $this->paye = $paye;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
     * @return Collection|Kafala[]
     */
    public function getKafalas(): Collection
    {
        return $this->kafalas;
    }

    public function addKafala(Kafala $kafala): self
    {
        if (!$this->kafalas->contains($kafala)) {
            $this->kafalas[] = $kafala;
            $kafala->setGarant($this);
        }

        return $this;
    }

    public function removeKafala(Kafala $kafala): self
    {
        if ($this->kafalas->contains($kafala)) {
            $this->kafalas->removeElement($kafala);
            // set the owning side to null (unless already changed)
            if ($kafala->getGarant() === $this) {
                $kafala->setGarant(null);
            }
        }

        return $this;
    }

}
