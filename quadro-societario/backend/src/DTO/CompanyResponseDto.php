<?php

namespace App\DTO;

use App\Entity\Company;

class CompanyResponseDto
{
    public int $id;
    public string $name;
    public string $cnpj;
    public ?string $address;

    public function __construct(Company $company)
    {
        $this->id = $company->getId();
        $this->name = $company->getName();
        $this->cnpj = $company->getCnpj();
        $this->address = $company->getAddress();
    }
}
