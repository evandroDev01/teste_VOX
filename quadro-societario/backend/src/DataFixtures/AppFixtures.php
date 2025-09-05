<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Partner;
use App\Entity\Role;
use App\Entity\PartnerRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/// testado as tabelas

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $company1 = new Company();
        $company1->setName('Empresa A');
        $company1->setCnpj("12.345.678/0001-90");
        $manager->persist($company1);

        $company2 = new Company();
        $company2->setName('Empresa B');
        $company2->setCnpj("98.765.432/0001-01");
        $manager->persist($company2);

        $role1 = new Role();
        $role1->setName('Administrador');
        $manager->persist($role1);

        $role2 = new Role();
        $role2->setName('Usuário');
        $manager->persist($role2);

        
        $partner1 = new Partner();
        $partner1->setName('Parceiro 1');
        $partner1->setCompany($company1);
        $partner1->setRole($role1);
        $partner1->setCpfCnpj("12345678901");
        $partner1->setSharePercentage(20);
        $manager->persist($partner1);

        $partner2 = new Partner();
        $partner2->setName('Parceiro 2');
        $partner2->setCompany($company2);
        $partner2->setRole($role2);
        $partner2->setCpfCnpj("98765432100");
        $partner2->setSharePercentage(40);
        $manager->persist($partner2);

        
        $pr1 = new PartnerRole();
        $pr1->setPartner($partner1);
        $pr1->setRole($role1);
        $manager->persist($pr1);

        $pr2 = new PartnerRole();
        $pr2->setPartner($partner2);
        $pr2->setRole($role2);
        $manager->persist($pr2);

        $manager->flush();
    }
}

