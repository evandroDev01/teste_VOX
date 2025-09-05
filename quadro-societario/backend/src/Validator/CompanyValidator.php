<?php

namespace App\Validator;

use App\DTO\CompanyRequestDto;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CompanyValidator
{
    public function validate(CompanyRequestDto $dto): void
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'name' => [new Assert\NotBlank(), new Assert\Length(['max' => 255])],
            'cnpj' => [new Assert\NotBlank(), new Assert\Length(['max' => 20])],
            'address' => [new Assert\Optional([new Assert\Length(['max' => 255])])],
        ]);

        $violations = $validator->validate([
            'name' => $dto->name,
            'cnpj' => $dto->cnpj,
            'address' => $dto->address
        ], $constraints);

        if (count($violations) > 0) {
            $messages = [];
            foreach ($violations as $violation) {
                $messages[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
            }
            throw new BadRequestHttpException(implode(", ", $messages));
        }
    }
}
