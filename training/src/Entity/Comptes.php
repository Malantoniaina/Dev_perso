<?php

namespace App\Entity;

use App\Repository\ComptesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptesRepository::class)]
class Comptes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $numeroCompte = null;

    #[ORM\Column]
    private ?float $solde = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    private ?clients $client = null;

    #[ORM\OneToMany(targetEntity: Payments::class, mappedBy: 'compte')]
    private Collection $payments;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(string $numeroCompte): static
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getClient(): ?clients
    {
        return $this->client;
    }

    public function setClient(?clients $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Payments>
     */
    public function getPaymentDate(): Collection
    {
        return $this->payments;
    }

    public function addPaymentDate(Payments $payments): static
    {
        if (!$this->payments->contains($payments)) {
            $this->payments->add($payments);
            $payments->setCompte($this);
        }

        return $this;
    }

    public function removePaymentDate(Payments $payments): static
    {
        if ($this->payments->removeElement($payments)) {
            // set the owning side to null (unless already changed)
            if ($payments->getCompte() === $this) {
                $payments->setCompte(null);
            }
        }

        return $this;
    }
}
