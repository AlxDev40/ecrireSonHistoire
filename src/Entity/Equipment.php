<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class, mappedBy="equipment")
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity=Road::class, mappedBy="necessary")
     */
    private $roadsConstrainte;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attack;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defense;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->roadsConstrainte = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
        }

        return $this;
    }

    /**
     * @return Collection|Road[]
     */
    public function getRoadsConstrainte(): Collection
    {
        return $this->roadsConstrainte;
    }

    public function addRoadsConstrainte(Road $roadsConstrainte): self
    {
        if (!$this->roadsConstrainte->contains($roadsConstrainte)) {
            $this->roadsConstrainte[] = $roadsConstrainte;
            $roadsConstrainte->setNecessary($this);
        }

        return $this;
    }

    public function removeRoadsConstrainte(Road $roadsConstrainte): self
    {
        if ($this->roadsConstrainte->contains($roadsConstrainte)) {
            $this->roadsConstrainte->removeElement($roadsConstrainte);
            // set the owning side to null (unless already changed)
            if ($roadsConstrainte->getNecessary() === $this) {
                $roadsConstrainte->setNecessary(null);
            }
        }

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(?int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(?int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }
}
