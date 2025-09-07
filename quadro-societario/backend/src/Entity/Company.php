<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['company:list', 'company:item', 'partner:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company:list', 'company:item', 'partner:item'])]
    private ?string $name = null;

    #[ORM\Column(length: 14)]
    #[Groups(['company:list', 'company:item'])]
    private ?string $cnpj = null;

    // Se quiser, pode adicionar relacionamento com Partner
    // #[ORM\OneToMany(mappedBy: "company", targetEntity: Partner::class)]
    // #[Groups(['company:item'])]
    // private Collection $partners;

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

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    // Se tiver parceiros
    // public function getPartners(): Collection
    // {
    //     return $this->partners;
    // }

    // public function addPartner(Partner $partner): self
    // {
    //     if (!$this->partners->contains($partner)) {
    //         $this->partners[] = $partner;
    //         $partner->setCompany($this);
    //     }
    //     return $this;
    // }

    // public function removePartner(Partner $partner): self
    // {
    //     if ($this->partners->removeElement($partner)) {
    //         if ($partner->getCompany() === $this) {
    //             $partner->setCompany(null);
    //         }
    //     }
    //     return $this;
    // }
}
