<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;


class CompanyDTO
{
    public ?int $id = null;

    #[Assert\NotBlank(message: "O nome é obrigatório")]
    #[Assert\Length(min: 2,max: 255,)]
    public ?string $name = null;

    #[Assert\NotBlank(message: "O CNPJ é obrigatório")]
    #[Assert\Length(min: 14, max: 14)]
    public ? string $cnpj = null;
}