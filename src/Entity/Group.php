<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserId;

    /**
     * @ORM\OneToMany(targetEntity=FlashCard::class, mappedBy="GroupId", orphanRemoval=true)
     */
    private $flashCards;

    public function __construct()
    {
        $this->flashCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->UserId;
    }

    public function setUserId(?User $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    /**
     * @return Collection|FlashCard[]
     */
    public function getFlashCards(): Collection
    {
        return $this->flashCards;
    }

    public function addFlashCard(FlashCard $flashCard): self
    {
        if (!$this->flashCards->contains($flashCard)) {
            $this->flashCards[] = $flashCard;
            $flashCard->setGroupId($this);
        }

        return $this;
    }

    public function removeFlashCard(FlashCard $flashCard): self
    {
        if ($this->flashCards->removeElement($flashCard)) {
            // set the owning side to null (unless already changed)
            if ($flashCard->getGroupId() === $this) {
                $flashCard->setGroupId(null);
            }
        }

        return $this;
    }
}
