<?php

namespace App\Services;

use App\Services\PixAsaasService\PixQrCodeAsaas;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use JsonException;

readonly class PixAsaasService implements AsaasServiceInterface
{
    public function __construct(
        private string $asaasApikey
    ) {
    }

    public function getPixQrCodeAsaas(
        string $id_asaas
    ): PixQrCodeAsaas {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', 'https://sandbox.asaas.com/api/v3/payments/'.$id_asaas.'/pixQrCode', [
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => $this->asaasApikey,
                ],
            ]);
            $jsonObj = json_decode($response->getBody(), null, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|JsonException $e) {
            Log::error($e->getMessage());

            return PixQrCodeAsaas::createEmpty();
        }

        return PixQrCodeAsaas::fromJsonObject($jsonObj);
    }
}
