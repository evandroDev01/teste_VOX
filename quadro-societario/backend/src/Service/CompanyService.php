<?php

namespace App\Service;

use App\Entity\Company;
use App\Dto\CompanyDTO;
use App\Repository\CompanyRepository;

class CompanyService
{
    public function __construct(private CompanyRepository $repository) {}

    public function create(CompanyDTO $dto): Company
    {
        $existing = $this->repository->findOneBy(['cnpj' => $dto->cnpj]);
        if ($existing) {
            throw new \Exception("CNPJ já cadastrado!");
        }

        $company = new Company();
        $company->setName($dto->name);
        $company->setCnpj($dto->cnpj);

        $this->repository->save($company);
        return $company;
    }

    public function update(Company $company, CompanyDTO $dto): Company
    {
        $company->setName($dto->name);
        $company->setCnpj($dto->cnpj);

        $this->repository->save($company);
        return $company;
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function getById(int $id): ?Company
    {
        return $this->repository->find($id);
    }

    public function delete(Company $company): void
    {
        $this->repository->remove($company);
    }

    public function getByFilter(?string $name = null): array
    {
        $qb = $this->repository->createQueryBuilder('c');

        if ($name) {
            $qb->where('c.name LIKE :name')
               ->setParameter('name', "%$name%");
        }

        return $qb->getQuery()->getResult();
    }
}
