<?php

namespace App\Services\CobrancaAsaasService\CobrancaAsaas;

use App\Services\AsaasServiceFactory;
use App\Services\CobrancaAsaasService\CobrancaAsaas;
use App\Services\PixAsaasService;
use DateTimeImmutable;
use Exception;

readonly class Pix extends CobrancaAsaas
{
    private function __construct(
        string $id,
        string $billingType,
        int $value,
        DateTimeImmutable $dueDate,
        private string $encodedImage,
        private string $payload,
    ) {
        parent::__construct($id, $billingType, $value, $dueDate);
    }

    public function getEncodedImage(): string
    {
        return $this->encodedImage;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @throws Exception
     */
    public static function fromJsonObject(object $jsonObj): self
    {
        $asaasServiceFactory = new AsaasServiceFactory();
        $pixAsaasService = $asaasServiceFactory->getAsaasService(PixAsaasService::class);
        assert($pixAsaasService instanceof PixAsaasService);
        $pixQrCodeAsaas = $pixAsaasService->getPixQrCodeAsaas($jsonObj->id);

        return new self(
            $jsonObj->id,
            $jsonObj->billingType,
            $jsonObj->value,
            new DateTimeImmutable($jsonObj->dueDate),
            $pixQrCodeAsaas->getEncodedImage(),
            $pixQrCodeAsaas->getPayload(),
        );
    }
}
