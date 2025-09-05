<?php


namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CompanyRequestDto
{
    public ?string $name;
    public ?string $cnpj;
    public ?string $address;


    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? null;
        $this->cnpj = $data['cnpj'] ?? null;
        $this->address = $data['address'] ?? null;
    }
}