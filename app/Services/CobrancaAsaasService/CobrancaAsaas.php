<?php

namespace App\Services\CobrancaAsaasService;

use App\Services\CobrancaAsaasService\CobrancaAsaas\Boleto;
use App\Services\CobrancaAsaasService\CobrancaAsaas\CreditCard;
use App\Services\CobrancaAsaasService\CobrancaAsaas\Pix;
use DateTimeImmutable;

readonly class CobrancaAsaas
{
    protected function __construct(
        private string $id,
        private string $billingType,
        private int $value,
        private DateTimeImmutable $dueDate,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBillingType(): string
    {
        return $this->billingType;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->dueDate;
    }

    public static function fromJsonObject(object $jsonObj): Boleto|Pix|CreditCard
    {
        switch ($jsonObj->billingType) {
            case 'BOLETO':
                return Boleto::fromJsonObject($jsonObj);
            case 'PIX':
                return Pix::fromJsonObject($jsonObj);
            case 'CREDIT_CARD':
                return CreditCard::fromJsonObject($jsonObj);
        }
    }

    public static function fromErrorResponseJsonObject(
        object $jsonObj,
        string $billingType,
        int $value,
        DateTimeImmutable $dueDate,
    ): CreditCard {
        switch ($jsonObj->billingType) {
            case 'CREDIT_CARD':
                return CreditCard::fromJsonObject($jsonObj);
        }
    }
}
