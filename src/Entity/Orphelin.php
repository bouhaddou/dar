<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrphelinRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Orphelin
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $setAt;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Kafala", mappedBy="Orphelin")
     */
    private $kafalas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Familly", inversedBy="orphelin")
     * @ORM\JoinColumn(nullable=false)
     */
    private $familly;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getFullName(){
        return "{$this->firstName} {$this->lastName}";
    }

    /**
     * @ORM\PrePersist
     */
    public function setStatusValue()
    {
        if(empty($this->status))
        {
        $this->status = false;
        }
    }

    public function getAge(){

        $datetime1 = new \DateTime(); // date actuelle
        $datetime2 = new \DateTime($this->setAt->format('d-m-Y'));
        $age = $datetime1->diff($datetime2, true)->y;
        return $age;
    }

    public function __construct()
    {
        $this->kafalas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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
            $kafala->setOrphelin($this);
        }

        return $this;
    }

    public function removeKafala(Kafala $kafala): self
    {
        if ($this->kafalas->contains($kafala)) {
            $this->kafalas->removeElement($kafala);
            // set the owning side to null (unless already changed)
            if ($kafala->getOrphelin() === $this) {
                $kafala->setOrphelin(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getFamilly(): ?Familly
    {
        return $this->familly;
    }

    public function setFamilly(?Familly $familly): self
    {
        $this->familly = $familly;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus( $status): self
    {
        $this->status = $status;

        return $this;
    }
}
