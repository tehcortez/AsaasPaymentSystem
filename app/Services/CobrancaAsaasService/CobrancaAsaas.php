<?php

namespace App\Services\CobrancaAsaasService;

use App\Services\CobrancaAsaasService\CobrancaAsaas\Boleto;
use App\Services\CobrancaAsaasService\CobrancaAsaas\CreditCard;
use App\Services\CobrancaAsaasService\CobrancaAsaas\Pix;
use App\Services\CobrancaAsaasService\Exception\AsaasDateException;
use DateTimeImmutable;
use InvalidArgumentException;

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

    /**
     * @throws AsaasDateException
     */
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
        throw new InvalidArgumentException('Billing type not found');
    }
}
