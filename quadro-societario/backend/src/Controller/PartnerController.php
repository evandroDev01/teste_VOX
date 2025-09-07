<?php

namespace App\Controller;

use App\DTO\PartnerDTO;
use App\Entity\Partner;
use App\Service\PartnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/partners')]
class PartnerController extends AbstractController
{
    private PartnerService $service;
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;

    public function __construct(PartnerService $service, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->service = $service;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $partners = $this->service->getAll();
        $data = $this->serializer->serialize($partners, 'json', ['groups' => 'partner:list']);

        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $partner = $this->service->getById($id);
        if (!$partner) {
            return new JsonResponse(['message' => 'Partner not found'], 404);
        }

        $data = $this->serializer->serialize($partner, 'json', ['groups' => 'partner:item']);
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $dto = new PartnerDTO();
        $data = json_decode($request->getContent(), true);

        $dto->name = $data['name'] ?? null;
        $dto->CpfCnpj = $data['CpfCnpj'] ?? null;
        $dto->companyId = $data['companyId'] ?? null;

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
            }
            return new JsonResponse(['errors' => $messages], 400);
        }

        $partner = $this->service->create($dto);
        $response = $this->serializer->serialize($partner, 'json', ['groups' => 'partner:item']);

        return new JsonResponse($response, 201, [], true);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $partner = $this->service->getById($id);
        if (!$partner) {
            return new JsonResponse(['message' => 'Partner not found'], 404);
        }

        $dto = new PartnerDTO();
        $data = json_decode($request->getContent(), true);

        $dto->name = $data['name'] ?? $partner->getName();
        $dto->CpfCnpj = $data['CpfCnpj'] ?? $partner->getCpfCnpj();
        $dto->companyId = $data['companyId'] ?? $partner->getCompany()?->getId();

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
            }
            return new JsonResponse(['errors' => $messages], 400);
        }

        $updatedPartner = $this->service->update($partner, $dto);
        $response = $this->serializer->serialize($updatedPartner, 'json', ['groups' => 'partner:item']);

        return new JsonResponse($response, 200, [], true);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $partner = $this->service->getById($id);
        if (!$partner) {
            return new JsonResponse(['message' => 'Partner not found'], 404);
        }

        $this->service->delete($partner);
        return new JsonResponse(null, 204);
    }
}
