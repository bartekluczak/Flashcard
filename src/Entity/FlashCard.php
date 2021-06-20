<?php

namespace App\Entity;

use App\Repository\FlashCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlashCardRepository::class)
 */
class FlashCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="flashCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $GroupId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Translation;

    /**
     * @ORM\OneToOne(targetEntity=Statistics::class, mappedBy="FlashCardId", cascade={"persist", "remove"})
     */
    private $statistics;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->Translation;
    }

    public function setTranslation(string $Translation): self
    {
        $this->Translation = $Translation;

        return $this;
    }

    public function getStatistics(): ?Statistics
    {
        return $this->statistics;
    }

    public function setStatistics(Statistics $statistics): self
    {
        // set the owning side of the relation if necessary
        if ($statistics->getFlashCardId() !== $this) {
            $statistics->setFlashCardId($this);
        }

        $this->statistics = $statistics;

        return $this;
    }
}
