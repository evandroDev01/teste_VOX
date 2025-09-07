<?php

namespace App\Service;

use App\Entity\Company;
use App\Dto\CompanyDTO;
use Doctrine\ORM\EntityManagerInterface;

class CompanyService
{
    private EntityManagerInterface  $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(CompanyDTO $dto): Company
    {
        $existing = $this->em->getRepository(Company::class)
        ->findOneBy(['cnpj' => $dto->cnpj]);

        if ($existing) {
            throw new \Exception("CNPJ já cadastrado!");
        }

        $company = new Company();
        $company->setName($dto->name);
        $company->setCnpj($dto->cnpj);

        $this->em->persist($company);
        $this->em->flush();

        return $company;
    }

    public function update(Company $company, CompanyDTO $dto): Company
    {
        $company->setName($dto->name);
        $company->setCnpj($dto->cnpj);

        $this->em->flush();
        return $company;
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Company::class)->findAll();
    }

    public function getById(int $id): ?Company
    {
        return $this->em->getRepository(Company::class)->find($id);
    }

    public function delete(Company $company): void
    {
        $this->em->remove($company);
        $this->em->flush();
    }

    public function getByFilter(?string $name = null): array
    {
        $repo = $this->em->getRepository(Company::class);
        $qb = $repo->createQueryBuilder('c');

        if ($name) {
            $qb->where('c.name LIKE :name')
            ->setParameter('name', "%$name%");
        }

        return $qb->getQuery()->getResult();
    }
}