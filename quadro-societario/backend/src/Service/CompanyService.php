<?php

namespace App\Service;

use App\Entity\Company;
use App\DTO\CompanyRequestDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyService
{
    private EntityManagerInterface $em;
    private \Doctrine\ORM\EntityRepository $repository;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Company::class);
    }


    public function getCompanies(CompanyRequestDto $dto): array
    {
        return $this->repository->findAll();
    }

    public function getCompanyById(int $id): Company
    {
        $company = $this->repository->find($id);
        if (!$company) {
            throw new NotFoundHttpException("Empresa não encontrada");
        }
        return $company;
    }

    public function createCompany(CompanyRequestDto $dto): Company
    {
        $company = new Company();
        $company->setName($dto->name ?? null);
        $company->setCnpj($dto->cnpj ?? null);

        $this->em->persist($company);
        $this->em->flush();

        return $company;
    }


    public function updateCompany(int $id, CompanyRequestDto $dto): Company 
    {
        $company = $this->getCompanyById($id);

        $company->setName($dto->name ?? $company->getName());
        $company->setCnpj($dto->cnpj ?? $company->getCnpj());

        $this->em->flush();

        return $company;
    }

    public function deleteCompany(int $id): void
    {
        $company = $this->getCompanyById($id);

        $this->em->remove($company);
        $this->em->flush();
    }
}