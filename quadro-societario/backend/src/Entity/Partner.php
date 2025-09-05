<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "partner")]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 20)]
    private string $cpfCnpj;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: "partners")]
    #[ORM\JoinColumn(nullable: false)]
    private Company $company;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: "partners")]
    #[ORM\JoinColumn(nullable: false)]
    private Role $role;

    #[ORM\Column(type: "float")]
    private float $sharePercentage;

    // getters e setters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }
    public function getCpfCnpj(): string { return $this->cpfCnpj; }
    public function setCpfCnpj(string $cpfCnpj): void { $this->cpfCnpj = $cpfCnpj; }
    public function getCompany(): Company { return $this->company; }
    public function setCompany(Company $company): void { $this->company = $company; }
    public function getRole(): Role { return $this->role; }
    public function setRole(Role $role): void { $this->role = $role; }
    public function getSharePercentage(): float { return $this->sharePercentage; }
    public function setSharePercentage(float $sharePercentage): void { $this->sharePercentage = $sharePercentage; }
}
