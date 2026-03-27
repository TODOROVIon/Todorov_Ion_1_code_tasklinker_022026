<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
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
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'tag')]
    private Collection $idProject;

    /**
     * @var Collection<int, Tache>
     */
    #[ORM\ManyToMany(targetEntity: Tache::class, mappedBy: 'tag')]
    private Collection $taches;

    public function __construct()
    {
        $this->idProject = new ArrayCollection();
        $this->taches = new ArrayCollection();
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
            $idProject->setTag($this);
        }

        return $this;
    }

    public function removeIdProject(Project $idProject): static
    {
        if ($this->idProject->removeElement($idProject)) {
            // set the owning side to null (unless already changed)
            if ($idProject->getTag() === $this) {
                $idProject->setTag(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): static
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->addTag($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            $tach->removeTag($this);
        }

        return $this;
    }
}
