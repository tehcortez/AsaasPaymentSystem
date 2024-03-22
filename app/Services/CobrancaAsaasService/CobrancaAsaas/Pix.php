<?php

namespace App\Services\CobrancaAsaasService\CobrancaAsaas;

use App\Services\AsaasServiceFactory;
use App\Services\CobrancaAsaasService\CobrancaAsaas;
use App\Services\CobrancaAsaasService\Exception\AsaasDateException;
use App\Services\PixAsaasService;
use DateTimeImmutable;
use Exception;
use Illuminate\Support\Facades\Log;

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
     * @throws AsaasDateException
     */
    public static function fromJsonObject(object $jsonObj): self
    {
        $asaasServiceFactory = new AsaasServiceFactory();
        $pixAsaasService = $asaasServiceFactory->getAsaasService(PixAsaasService::class);
        assert($pixAsaasService instanceof PixAsaasService);
        $pixQrCodeAsaas = $pixAsaasService->getPixQrCodeAsaas($jsonObj->id);
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
            $pixQrCodeAsaas->getEncodedImage(),
            $pixQrCodeAsaas->getPayload(),
        );
    }
}
