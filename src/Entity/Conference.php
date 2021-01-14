<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ConferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConferenceRepository::class)
 */
class Conference
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private ?string $year = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isInternational;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="conference", orphanRemoval=true)
     */
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getCity() . ' - ' . $this->getYear();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getIsInternational(): bool
    {
        return $this->isInternational;
    }

    public function setIsInternational(bool $isInternational): self
    {
        $this->isInternational = $isInternational;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setConference($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        $this->comments->removeElement($comment);

        return $this;
    }
}
