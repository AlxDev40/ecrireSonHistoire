<?php

namespace App\Entity;

use App\Repository\RoadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoadRepository::class)
 */
class Road
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
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="roads")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chapter;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="targetRoads")
     */
    private $targetChapter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraph;

    /**
     * @ORM\ManyToOne(targetEntity=Equipment::class, inversedBy="roadsConstrainte")
     */
    private $necessary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    public function setChapter(?Chapter $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getTargetChapter(): ?Chapter
    {
        return $this->targetChapter;
    }

    public function setTargetChapter(?Chapter $targetChapter): self
    {
        $this->targetChapter = $targetChapter;

        return $this;
    }

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(?string $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getNecessary(): ?Equipment
    {
        return $this->necessary;
    }

    public function setNecessary(?Equipment $necessary): self
    {
        $this->necessary = $necessary;

        return $this;
    }
}
