<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ChapterRepository::class)
 * @UniqueEntity(
 * fields={"number"},
 * message="Vous ne pouvez avoir deux chapitres ayant le même numéro !"
 * )
 
 */
class Chapter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="chapters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\OneToMany(targetEntity=Road::class, mappedBy="chapter", orphanRemoval=true)
     */
    private $roads;

    /**
     * @ORM\OneToMany(targetEntity=Road::class, mappedBy="targetChapter")
     */
    private $targetRoads;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="currentChapter")
     */
    private $characters;

    public function __construct()
    {
        $this->roads = new ArrayCollection();
        $this->targetRoads = new ArrayCollection();
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Collection|Road[]
     */
    public function getRoads(): Collection
    {
        return $this->roads;
    }

    public function addRoad(Road $road): self
    {
        if (!$this->roads->contains($road)) {
            $this->roads[] = $road;
            $road->setChapter($this);
        }

        return $this;
    }

    public function removeRoad(Road $road): self
    {
        if ($this->roads->contains($road)) {
            $this->roads->removeElement($road);
            // set the owning side to null (unless already changed)
            if ($road->getChapter() === $this) {
                $road->setChapter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Road[]
     */
    public function getTargetRoads(): Collection
    {
        return $this->targetRoads;
    }

    public function addTargetRoad(Road $targetRoad): self
    {
        if (!$this->targetRoads->contains($targetRoad)) {
            $this->targetRoads[] = $targetRoad;
            $targetRoad->setTargetChapter($this);
        }

        return $this;
    }

    public function removeTargetRoad(Road $targetRoad): self
    {
        if ($this->targetRoads->contains($targetRoad)) {
            $this->targetRoads->removeElement($targetRoad);
            // set the owning side to null (unless already changed)
            if ($targetRoad->getTargetChapter() === $this) {
                $targetRoad->setTargetChapter(null);
            }
        }

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
            $character->setCurrentChapter($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            // set the owning side to null (unless already changed)
            if ($character->getCurrentChapter() === $this) {
                $character->setCurrentChapter(null);
            }
        }

        return $this;
    }
}
