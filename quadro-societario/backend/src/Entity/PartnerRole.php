<?php

namespace App\Entity;

use App\Repository\PartnerRoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRoleRepository::class)]
#[ORM\Table(name: "partner_role")]
class PartnerRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    // ManyToOne para Partner
    #[ORM\ManyToOne(targetEntity: Partner::class)]
    #[ORM\JoinColumn(name: "partner_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Partner $partner = null;

    // ManyToOne para Role
    #[ORM\ManyToOne(targetEntity: Role::class)]
    #[ORM\JoinColumn(name: "role_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Role $role = null;

    // Getters e Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;
        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;
        return $this;
    }
}
