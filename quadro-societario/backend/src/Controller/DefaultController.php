<?php


// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Partner;
use App\Entity\Role;
use App\Entity\PartnerRole;


class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return new Response('Bem-vindo ao Symfony!');
    }

    #[Route("/teste-dados", name: "teste_tabelas")]
    public function testeDados(EntityManagerInterface $em): Response
    {
        $partners = $em->getRepository(Partner::class)->findAll();
        $roles = $em->getRepository(Role::class)->findAll();
        $partnerRoles = $em->getRepository(PartnerRole::class)->findAll();

        return new Response(
            'Partners: ' . count($partners) . '<br>' .
            'Roles: ' . count($roles) . '<br>' .
            'PartnerRoles: ' . count($partnerRoles)
        );
    }
}




?>