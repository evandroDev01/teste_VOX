<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\PartnerRepository")]
class Partner
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
    #[Groups(["partner:list", "partner:item"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["partner:list", "partner:item"])]
    private ?string $name = null;

    #[ORM\Column(length: 14)]
    #[Groups(["partner:list", "partner:item"])]
    private ?string $cpfCnpj = null;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["partner:item"])]
    private ?Company $company = null;

    
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

    public function getCpfCnpj(): ?string
    {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj(string $cpfCnpj): self
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;
        return $this;
    }
}
