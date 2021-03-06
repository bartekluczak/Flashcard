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
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groups")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $UserId;

    /**
     * @ORM\OneToMany(targetEntity=FlashCard::class, mappedBy="GroupId",)
     */
    private $flashCards;

    /**
     * @ORM\OneToMany(targetEntity=Statistics::class, mappedBy="GroupId",)
     */
    private $statistics;

    /**
     * @ORM\OneToMany(targetEntity=Session::class, mappedBy="groupId")
     */
    private $sessions;

    public function __construct()
    {
        $this->flashCards = new ArrayCollection();
        $this->statistics = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

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

    /**
     * @return Collection|Statistics[]
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(Statistics $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setGroupId($this);
        }

        return $this;
    }

    public function removeStatistic(Statistics $statistic): self
    {
        if ($this->statistics->removeElement($statistic)) {
            // set the owning side to null (unless already changed)
            if ($statistic->getGroupId() === $this) {
                $statistic->setGroupId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Name;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setGroupId($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getGroupId() === $this) {
                $session->setGroupId(null);
            }
        }

        return $this;
    }
}
