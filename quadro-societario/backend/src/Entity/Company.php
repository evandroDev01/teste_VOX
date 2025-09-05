<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "company")]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 20)]
    private string $cnpj;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: "company", targetEntity: Partner::class)]
    private Collection $partners;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
    }


    public function getId(): int {
        return $this->id; 
    }

    public function getName(): string {
        return $this->name; 
    }

    public function setName(string $name): void { 
        $this->name = $name; 
    }

    public function getCnpj(): string { 
        return $this->cnpj; 
    }

    public function setCnpj(string $cnpj): void {
        $this->cnpj = $cnpj; 
    }

    public function getAddress(): ?string { 
        return $this->address; 
    }

    public function setAddress(?string $address): void {
        $this->address = $address; 
    }
    public function getPartners(): Collection {
        return $this->partners; 
    }
}
