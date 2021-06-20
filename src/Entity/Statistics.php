<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Flashcard::class, inversedBy="statistics", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $FlashCardId;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $GroupId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $correctCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $incorrectCount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlashCardId(): ?Flashcard
    {
        return $this->FlashCardId;
    }

    public function setFlashCardId(Flashcard $FlashCardId): self
    {
        $this->FlashCardId = $FlashCardId;

        return $this;
    }

    public function getGroupId(): ?Group
    {
        return $this->GroupId;
    }

    public function setGroupId(?Group $GroupId): self
    {
        $this->GroupId = $GroupId;

        return $this;
    }

    public function getCorrectCount(): ?int
    {
        return $this->correctCount;
    }

    public function setCorrectCount(?int $correctCount): self
    {
        $this->correctCount = $correctCount;

        return $this;
    }

    public function getIncorrectCount(): ?int
    {
        return $this->incorrectCount;
    }

    public function setIncorrectCount(?int $incorrectCount): self
    {
        $this->incorrectCount = $incorrectCount;

        return $this;
    }
}
