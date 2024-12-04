<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    private ?string $email = null;

    #[ORM\Column(length: 40)]
    private ?string $adresse = null;

    #[ORM\Column(length: 12)]
    private ?string $telephone = null;

    #[ORM\Column(length: 12)]
    private ?string $cin = null;

    #[ORM\OneToMany(targetEntity: Comptes::class, mappedBy: 'client')]
    private Collection $comptes;

    #[ORM\OneToMany(targetEntity: Payments::class, mappedBy: 'client')]
    private Collection $payments;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return Collection<int, Comptes>
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Comptes $compte): static
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes->add($compte);
            $compte->setClient($this);
        }

        return $this;
    }

    public function removeCompte(Comptes $compte): static
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getClient() === $this) {
                $compte->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payments>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payments $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setClient($this);
        }

        return $this;
    }

    public function removePayment(Payments $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getClient() === $this) {
                $payment->setClient(null);
            }
        }

        return $this;
    }
}
