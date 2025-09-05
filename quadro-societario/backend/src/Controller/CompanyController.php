<?php

namespace App\Controller;

use App\DTO\CompanyRequestDto;
use App\DTO\CompanyResponseDto;
use App\Service\CompanyService;
use App\Validator\CompanyValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/companies")]
class CompanyController extends AbstractController
{
    private CompanyService $service;
    private CompanyValidator $validator;

    public function __construct(CompanyService $service, CompanyValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    #[Route("", name: "company_list", methods: ["GET"])]
    public function listCompanies(Request $request): JsonResponse
    {
        $dto = new CompanyRequestDto($request->query->all());
        $companies = $this->service->getCompanies($dto);

        $response = array_map(fn($c) => new CompanyResponseDto($c), $companies);

        return $this->json($response);
    }

    #[Route("", name: "company_create", methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        $dto = new CompanyRequestDto($request->request->all());
        $this->validator->validate($dto);

        $company = $this->service->createCompany($dto);

        return $this->json(new CompanyResponseDto($company), JsonResponse::HTTP_CREATED);
    }

    #[Route("/{id}", name: "company_get", methods: ["GET"])]
    public function getCompany(int $id): JsonResponse
    {
        $company = $this->service->getCompanyById($id);

        return $this->json(new CompanyResponseDto($company));
    }

    #[Route("/{id}", name: "company_update", methods: ["PUT"])]
    public function update(Request $request, int $id): JsonResponse
    {
        $dto = new CompanyRequestDto(json_decode($request->getContent(), true));
        $this->validator->validate($dto);

        $company = $this->service->updateCompany($id, $dto);

        return $this->json(new CompanyResponseDto($company));
    }

    #[Route("/{id}", name: "company_delete", methods: ["DELETE"])]
    public function delete(int $id): JsonResponse
    {
        $this->service->deleteCompany($id);

        return $this->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
