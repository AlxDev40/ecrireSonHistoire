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
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $itinerary;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="targetRoads")
     */
    private $targetChapter;


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

    public function getItinerary(): ?string
    {
        return $this->itinerary;
    }

    public function setItinerary(?string $itinerary): self
    {
        $this->itinerary = $itinerary;

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


}
