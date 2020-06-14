<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\NotNull
     */
    private $characterName;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="characters")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lifePoint;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dexterity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attack;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defense;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity=Equipment::class, inversedBy="characters")
     */
    private $equipment;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="characters")
     */
    private $currentChapter;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacterName(): ?string
    {
        return $this->characterName;
    }

    public function setCharacterName(string $characterName): self
    {
        $this->characterName = $characterName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLifePoint(): ?string
    {
        return $this->lifePoint;
    }

    public function setLifePoint(?string $lifePoint): self
    {
        $this->lifePoint = $lifePoint;

        return $this;
    }

    public function getDexterity(): ?string
    {
        return $this->dexterity;
    }

    public function setDexterity(?string $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getAttack(): ?string
    {
        return $this->attack;
    }

    public function setAttack(?string $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?string
    {
        return $this->defense;
    }

    public function setDefense(?string $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->addCharacter($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipment->contains($equipment)) {
            $this->equipment->removeElement($equipment);
            $equipment->removeCharacter($this);
        }

        return $this;
    }

    public function getCurrentChapter(): ?Chapter
    {
        return $this->currentChapter;
    }

    public function setCurrentChapter(?Chapter $currentChapter): self
    {
        $this->currentChapter = $currentChapter;

        return $this;
    }
}
