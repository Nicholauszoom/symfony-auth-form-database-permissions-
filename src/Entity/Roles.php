<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'roles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $roles = null;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

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

    public function getRoles(): ?self
    {
        return $this->roles;
    }

    public function setRoles(?self $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    // public function addRole(self $role): self
    // {
    //     if (!$this->roles->contains($role)) {
    //         $this->roles->add($role);
    //         $role->setRoles($this);
    //     }

    //     return $this;
    // }

    // public function removeRole(self $role): self
    // {
    //     if ($this->roles->removeElement($role)) {
    //         // set the owning side to null (unless already changed)
    //         if ($role->getRoles() === $this) {
    //             $role->setRoles(null);
    //         }
    //     }

    //     return $this;
    // }
}
