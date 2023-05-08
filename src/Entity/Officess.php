<?php

namespace App\Entity;

use App\Repository\OfficessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfficessRepository::class)]
class Officess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\ManyToOne(inversedBy: 'offices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Building $building = null;



    // #[ORM\Column(length: 255)]
    // private ?string $ImagePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    // public function getImagePath(): ?string
    // {
    //     return $this->ImagePath;
    // }

    // public function setImagePath(string $ImagePath): self
    // {
    //     $this->ImagePath = $ImagePath;

    //     return $this;
    // }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }



}
