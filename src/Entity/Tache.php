<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $deadline = null;

    #[ORM\ManyToOne(inversedBy: 'idStatus')]
    private ?Project $idProject = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Status $idStatus = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Users $idUser = null;

    /**
     * @var Collection<int, TimeTable>
     */
    #[ORM\OneToMany(targetEntity: TimeTable::class, mappedBy: 'idTache')]
    private Collection $timeTables;

    public function __construct()
    {
        $this->timeTables = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getIdProject(): ?Project
    {
        return $this->idProject;
    }

    public function setIdProject(?Project $idProject): static
    {
        $this->idProject = $idProject;

        return $this;
    }

    public function getIdStatus(): ?Status
    {
        return $this->idStatus;
    }

    public function setIdStatus(?Status $idStatus): static
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection<int, TimeTable>
     */
    public function getTimeTables(): Collection
    {
        return $this->timeTables;
    }

    public function addTimeTable(TimeTable $timeTable): static
    {
        if (!$this->timeTables->contains($timeTable)) {
            $this->timeTables->add($timeTable);
            $timeTable->setIdTache($this);
        }

        return $this;
    }

    public function removeTimeTable(TimeTable $timeTable): static
    {
        if ($this->timeTables->removeElement($timeTable)) {
            // set the owning side to null (unless already changed)
            if ($timeTable->getIdTache() === $this) {
                $timeTable->setIdTache(null);
            }
        }

        return $this;
    }
}
