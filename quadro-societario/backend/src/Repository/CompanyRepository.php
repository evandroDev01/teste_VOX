<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function save(Company $company): void
    {
        $this->_em->persist($company);
        $this->_em->flush();
    }


    public function remove(Company $company): void
    {
        $this->_em->remove($company);
        $this->_em->flush();
    }
}
