<?php

namespace App\Entity;

use App\Repository\FlashCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlashCardRepository::class)
 * @ORM\Table(name="flashcard")
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
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="CASCADE")
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

}
