<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'status')]
    private Collection $idProject;

    public function __construct()
    {
        $this->idProject = new ArrayCollection();
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

    /**
     * @return Collection<int, Project>
     */
    public function getIdProject(): Collection
    {
        return $this->idProject;
    }

    public function addIdProject(Project $idProject): static
    {
        if (!$this->idProject->contains($idProject)) {
            $this->idProject->add($idProject);
            $idProject->setStatus($this);
        }

        return $this;
    }

    public function removeIdProject(Project $idProject): static
    {
        if ($this->idProject->removeElement($idProject)) {
            // set the owning side to null (unless already changed)
            if ($idProject->getStatus() === $this) {
                $idProject->setStatus(null);
            }
        }

        return $this;
    }
}
