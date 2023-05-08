<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

//    #[ORM\Column,nullable: true]
//    private ?int $number = null;



    #[ORM\OneToOne(inversedBy: 'classroom', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Building $buildings = null;

    #[ORM\ManyToMany(targetEntity: Infrastructure::class, inversedBy: 'classrooms')]
    private Collection $infrastructure;

    #[ORM\OneToOne(mappedBy: 'classroom', cascade: ['persist', 'remove'])]
    private ?Messages $messages = null;

    public function __construct()
    {
        $this->infrastructure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

//    public function getNumber(): ?int
//    {
//        return $this->number;
//    }

//    public function setNumber(int $number): self
//    {
//        $this->number = $number;
//
//        return $this;
//    }



    public function getBuildings(): ?Building
    {
        return $this->buildings;
    }

    public function setBuildings(Building $buildings): self
    {
        $this->buildings = $buildings;

        return $this;
    }

    /**
     * @return Collection<int, Infrastructure>
     */
    public function getInfrastructure(): Collection
    {
        return $this->infrastructure;
    }

    public function addInfrastructure(Infrastructure $infrastructure): self
    {
        if (!$this->infrastructure->contains($infrastructure)) {
            $this->infrastructure->add($infrastructure);
        }

        return $this;
    }

    public function removeInfrastructure(Infrastructure $infrastructure): self
    {
        $this->infrastructure->removeElement($infrastructure);

        return $this;
    }

    public function getMessages(): ?Messages
    {
        return $this->messages;
    }

    public function setMessages(Messages $messages): self
    {
        // set the owning side of the relation if necessary
        if ($messages->getClassroom() !== $this) {
            $messages->setClassroom($this);
        }

        $this->messages = $messages;

        return $this;
    }
}
