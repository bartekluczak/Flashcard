<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $correctCount;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $incorrectCount;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="sessions")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $groupId;

    public function getId(): ?int
    {
        return $this->id;
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

    public function increaseCorrectCount()
    {
        $this->correctCount++;
    }

    public function getIncorrectCount(): ?int
    {
        return $this->incorrectCount;
    }

    public function increaseIncorrectCount()
    {
        $this->incorrectCount++;
    }

    public function setIncorrectCount(?int $incorrectCount): self
    {
        $this->incorrectCount = $incorrectCount;

        return $this;
    }

    public function getGroupId(): ?Group
    {
        return $this->groupId;
    }

    public function setGroupId(?Group $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }
}
