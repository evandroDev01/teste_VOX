<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class PartnerDTO
{
    public ?int $id = null;

    #[Assert\NotBlank(message: "O nome é obrigatório")]
    #[Assert\Length(min: 2,max: 255)]
    public ?string $name = null;

    #[Assert\NotBlank(message: "CPF/CNPJ é obrigatório")]
    #[Assert\Length(min: 11, max: 14)]
    public ?string $CpfCnpj = null;

    
    #[Assert\NotBlank(message: "CompanyId é obrigatório")]
    public ?int $companyId = null;
}