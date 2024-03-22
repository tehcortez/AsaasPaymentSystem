<?php

namespace App\Services\CobrancaAsaasService\CobrancaAsaas;

use App\Services\CobrancaAsaasService\CobrancaAsaas;
use App\Services\CobrancaAsaasService\Exception\AsaasDateException;
use DateTimeImmutable;
use Exception;
use Illuminate\Support\Facades\Log;

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
     * @throws AsaasDateException
     */
    public static function fromJsonObject(object $jsonObj): self
    {
        try {
            $dueDate = new DateTimeImmutable($jsonObj->dueDate);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new AsaasDateException();
        }
        return new self(
            $jsonObj->id,
            $jsonObj->billingType,
            $jsonObj->value,
            $dueDate,
            $jsonObj->bankSlipUrl
        );
    }
}
