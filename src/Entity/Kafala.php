<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KafalaRepository")
 */
class Kafala
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $setAtdebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orphelin", inversedBy="kafalas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Orphelin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Garant", inversedBy="kafalas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garant;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSetAtdebut(): ?\DateTimeInterface
    {
        return $this->setAtdebut;
    }

    public function setSetAtdebut(\DateTimeInterface $setAtdebut): self
    {
        $this->setAtdebut = $setAtdebut;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOrphelin(): ?Orphelin
    {
        return $this->Orphelin;
    }

    public function setOrphelin(?Orphelin $Orphelin): self
    {
        $this->Orphelin = $Orphelin;

        return $this;
    }

    public function getGarant(): ?Garant
    {
        return $this->garant;
    }

    public function setGarant(?Garant $garant): self
    {
        $this->garant = $garant;

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

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }
}
