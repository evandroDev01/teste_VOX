<?php

namespace App\Controller;

use App\DTO\CompanyDTO;
use App\Entity\Company;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route("/api/companies")]
class CompanyController extends AbstractController
{
    public function __construct(
        private CompanyService $service,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {}

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $companies = $this->service->getAll();
        $data = $this->serializer->serialize($companies, 'json', ['groups' => 'company:list']);
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $company = $this->service->getById($id);
        if (!$company) {
            return new JsonResponse(['message' => 'Company not found'], 404);
        }

        $data = $this->serializer->serialize($company, 'json', ['groups' => 'company:item']);
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $dto = $this->mapRequestToDTO($request);

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->validationErrorsResponse($errors);
        }

        $company = $this->service->create($dto);
        $response = $this->serializer->serialize($company, 'json', ['groups' => 'company:item']);
        return new JsonResponse($response, 201, [], true);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $company = $this->service->getById($id);
        if (!$company) {
            return new JsonResponse(['message' => 'Company not found'], 404);
        }

        $dto = $this->mapRequestToDTO($request, $company);

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->validationErrorsResponse($errors);
        }

        $updatedCompany = $this->service->update($company, $dto);
        $response = $this->serializer->serialize($updatedCompany, 'json', ['groups' => 'company:item']);
        return new JsonResponse($response, 200, [], true);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $company = $this->service->getById($id);
        if (!$company) {
            return new JsonResponse(['message' => 'Company not found'], 404);
        }

        $this->service->delete($company);
        return new JsonResponse(null, 204);
    }

    private function mapRequestToDTO(Request $request, ?Company $company = null): CompanyDTO
    {
        $data = json_decode($request->getContent(), true);

        $dto = new CompanyDTO();
        $dto->name = $data['name'] ?? $company?->getName();
        $dto->cnpj = $data['cnpj'] ?? $company?->getCnpj();

        return $dto;
    }

    private function validationErrorsResponse($errors): JsonResponse
    {
        $messages = [];
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
        }
        return new JsonResponse(['errors' => $messages], 400);
    }
}
