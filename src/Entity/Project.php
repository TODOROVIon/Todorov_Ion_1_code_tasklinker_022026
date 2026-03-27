<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTime $start__date = null;

    #[ORM\Column]
    private ?\DateTime $deadline = null;

    #[ORM\Column]
    private ?bool $archived = null;

    #[ORM\ManyToOne(inversedBy: 'idProject')]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'idProject')]
    private ?Tag $tag = null;

    /**
     * @var Collection<int, Tache>
     */
    #[ORM\OneToMany(targetEntity: Tache::class, mappedBy: 'idProject')]
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->start__date;
    }

    public function setStartDate(\DateTime $start__date): static
    {
        $this->start__date = $start__date;

        return $this;
    }

    public function getDeadline(): ?\DateTime
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTime $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): static
    {
        $this->archived = $archived;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    
    }
