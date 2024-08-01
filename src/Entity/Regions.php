<?php

namespace App\Entity;

use App\Repository\RegionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionsRepository::class)]
class Regions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'regions', orphanRemoval: true)]
    private Collection $users;

    /**
     * @var Collection<int, Departements>
     */
    #[ORM\OneToMany(targetEntity: Departements::class, mappedBy: 'regiondep', orphanRemoval: true)]
    private Collection $departements;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->departements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setRegions($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRegions() === $this) {
                $user->setRegions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Departements>
     */
    public function getDepartements(): Collection
    {
        return $this->departements;
    }

    public function addDepartement(Departements $departement): static
    {
        if (!$this->departements->contains($departement)) {
            $this->departements->add($departement);
            $departement->setRegiondep($this);
        }

        return $this;
    }

    public function removeDepartement(Departements $departement): static
    {
        if ($this->departements->removeElement($departement)) {
            // set the owning side to null (unless already changed)
            if ($departement->getRegiondep() === $this) {
                $departement->setRegiondep(null);
            }
        }

        return $this;
    }
}
