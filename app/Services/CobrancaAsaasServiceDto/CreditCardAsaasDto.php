<?php

namespace App\Services\CobrancaAsaasServiceDto;

readonly class CreditCardAsaasDto
{
    private function __construct(
        public string $holderName,
        public string $number,
        public string $expiryMonth,
        public string $expiryYear,
        public string $ccv,
    ) {
    }

    public static function create(
        string $holderName,
        string $number,
        string $expiryMonth,
        string $expiryYear,
        string $ccv
    ): self {
        return new self($holderName, $number, $expiryMonth, $expiryYear, $ccv);
    }

    public function toArray(): array
    {
        return [
            'holderName' => $this->holderName,
            'number' => $this->number,
            'expiryMonth' => $this->expiryMonth,
            'expiryYear' => $this->expiryYear,
            'ccv' => $this->ccv,
        ];
    }
}
