<?php

namespace App\Entity;

use App\Repository\TimeTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeTableRepository::class)]
class TimeTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $start__date = null;

    #[ORM\Column]
    private ?\DateTime $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'timeTables')]
    private ?Users $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'timeTables')]
    private ?Tache $idTache = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEndDate(): ?\DateTime
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTime $end_date): static
    {
        $this->end_date = $end_date;

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

    public function getIdTache(): ?Tache
    {
        return $this->idTache;
    }

    public function setIdTache(?Tache $idTache): static
    {
        $this->idTache = $idTache;

        return $this;
    }
}
