<?php

namespace App\Services\CobrancaAsaasServiceDto;

readonly class CreditCardHolderInfoAsaasDto
{
    private function __construct(
        public string $name,
        public string $email,
        public string $cpfCnpj,
        public string $postalCode,
        public string $addressNumber,
        public string $addressComplement,
        public string $phone,
    ) {
    }

    public static function create(
        string $name,
        string $email,
        string $cpfCnpj,
        string $postalCode,
        string $addressNumber,
        string $addressComplement,
        string $phone,
    ): self {
        return new self($name, $email, $cpfCnpj, $postalCode, $addressNumber, $addressComplement, $phone);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpfCnpj' => $this->cpfCnpj,
            'postalCode' => $this->postalCode,
            'addressNumber' => $this->addressNumber,
            'addressComplement' => $this->addressComplement,
            'phone' => $this->phone,
        ];
    }
}
