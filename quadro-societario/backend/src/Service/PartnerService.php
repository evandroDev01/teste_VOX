<?php

namespace App\Service;

use App\Entity\Partner;
use App\Entity\Company;
use App\DTO\PartnerDTO;
use Doctrine\ORM\EntityManagerInterface;

class PartnerService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(PartnerDTO $dto): Partner
    {
        $company = $this->em->getRepository(Company::class)->find($dto->companyId);
        if (!$company) {
            throw new \InvalidArgumentException("Company not found");
        }

        $partner = new Partner();
        $partner->setName($dto->name);
        $partner->setCpfCnpj($dto->CpfCnpj);
        $partner->setCompany($company);

        $this->em->persist($partner);
        $this->em->flush();

        return $partner;
    }

    public function update(Partner $partner, PartnerDTO $dto): Partner
    {
        $company = $this->em->getRepository(Company::class)->find($dto->companyId);
        if (!$company) {
            throw new \InvalidArgumentException("Company not found");
        }

        $partner->setName($dto->name);
        $partner->setCpfCnpj($dto->CpfCnpj);
        $partner->setCompany($company);

        $this->em->flush();
        return $partner;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Partner::class)->findAll();
    }

    public function getById(int $id): ?Partner
    {
        return $this->em->getRepository(Partner::class)->find($id);
    }

    public function delete(Partner $partner): void
    {
        $this->em->remove($partner);
        $this->em->flush();
    }


}