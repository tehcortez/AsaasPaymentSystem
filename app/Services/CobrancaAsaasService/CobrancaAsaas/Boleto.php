<?php

namespace App\Services\CobrancaAsaasService\CobrancaAsaas;

use App\Services\CobrancaAsaasService\CobrancaAsaas;
use DateTimeImmutable;
use Exception;

readonly class Boleto extends CobrancaAsaas
{
    private function __construct(
        string $id,
        string $billingType,
        int $value,
        DateTimeImmutable $dueDate,
        private string $bankSlipUrl,
    ) {
        parent::__construct($id, $billingType, $value, $dueDate);
    }

    public function getBankSlipUrl(): string
    {
        return $this->bankSlipUrl;
    }

    /**
     * @throws Exception
     */
    public static function fromJsonObject(object $jsonObj): self
    {
        return new self(
            $jsonObj->id,
            $jsonObj->billingType,
            $jsonObj->value,
            new DateTimeImmutable($jsonObj->dueDate),
            $jsonObj->bankSlipUrl
        );
    }
}
