<?php

namespace App\Service;

use App\Entity\Partner;
use App\Entity\Company;
use App\DTO\PartnerDTO;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PartnerService
{
    public function __construct(
        private PartnerRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function getById(int $id): ?Partner
    {
        return $this->repository->find($id);
    }

    public function create(PartnerDTO $dto): Partner
    {
        $partner = new Partner();
        $partner->setName($dto->name);
        $partner->setCpfCnpj($dto->CpfCnpj);

        if ($dto->companyId) {
            $company = $this->em->getRepository(Company::class)->find($dto->companyId);
            if ($company) {
                $partner->setCompany($company);
            }
        }

        $this->repository->save($partner);

        return $partner;
    }

    public function update(Partner $partner, PartnerDTO $dto): Partner
    {
        $partner->setName($dto->name ?? $partner->getName());
        $partner->setCpfCnpj($dto->cpfCnpj ?? $partner->getCpfCnpj());

        if ($dto->companyId) {
            $company = $this->em->getRepository(Company::class)->find($dto->companyId);
            if ($company) {
                $partner->setCompany($company);
            }
        }

        $this->repository->save($partner);

        return $partner;
    }

    public function delete(Partner $partner): void
    {
        $this->repository->remove($partner);
    }
}
