<?php

namespace App\Entity;

use App\Repository\ApprenantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprenantsRepository::class)]
class Apprenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeNaissance = null;

    #[ORM\Column]
    private ?float $numCNI = null;

    #[ORM\Column(length: 13)]
    private ?string $numeroUrgence = null;

    #[ORM\Column(length: 2)]
    private ?string $copieCNI = null;

    #[ORM\Column(length: 50)]
    private ?string $PersonneAContacter = null;

    #[ORM\ManyToMany(targetEntity: personnes::class, inversedBy: 'apprenants')]
    private Collection $idCohorte;

    #[ORM\ManyToMany(targetEntity: personnes::class, inversedBy: 'apprenants')]
    private Collection $idPersonne;

    public function __construct()
    {
        $this->idCohorte = new ArrayCollection();
        $this->idPersonne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getNumCNI(): ?float
    {
        return $this->numCNI;
    }

    public function setNumCNI(float $numCNI): self
    {
        $this->numCNI = $numCNI;

        return $this;
    }

    public function getNumeroUrgence(): ?string
    {
        return $this->numeroUrgence;
    }

    public function setNumeroUrgence(string $numeroUrgence): self
    {
        $this->numeroUrgence = $numeroUrgence;

        return $this;
    }

    public function getCopieCNI(): ?string
    {
        return $this->copieCNI;
    }

    public function setCopieCNI(string $copieCNI): self
    {
        $this->copieCNI = $copieCNI;

        return $this;
    }

    public function getPersonneAContacter(): ?string
    {
        return $this->PersonneAContacter;
    }

    public function setPersonneAContacter(string $PersonneAContacter): self
    {
        $this->PersonneAContacter = $PersonneAContacter;

        return $this;
    }

    /**
     * @return Collection<int, personnes>
     */
    public function getIdCohorte(): Collection
    {
        return $this->idCohorte;
    }

    public function addIdCohorte(personnes $idCohorte): self
    {
        if (!$this->idCohorte->contains($idCohorte)) {
            $this->idCohorte->add($idCohorte);
        }

        return $this;
    }

    public function removeIdCohorte(personnes $idCohorte): self
    {
        $this->idCohorte->removeElement($idCohorte);

        return $this;
    }

    /**
     * @return Collection<int, personnes>
     */
    public function getIdPersonne(): Collection
    {
        return $this->idPersonne;
    }

    public function addIdPersonne(personnes $idPersonne): self
    {
        if (!$this->idPersonne->contains($idPersonne)) {
            $this->idPersonne->add($idPersonne);
        }

        return $this;
    }

    public function removeIdPersonne(personnes $idPersonne): self
    {
        $this->idPersonne->removeElement($idPersonne);

        return $this;
    }
}
