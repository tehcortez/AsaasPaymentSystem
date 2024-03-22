<?php

namespace App\Services;

use App\Services\UsuarioAsaasService\UsuarioAsaas;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use JsonException;

class UsuarioAsaasService implements AsaasServiceInterface, UsuarioAsaasServiceInterface
{
    public function __construct(
        private string $asaasApikey
    ) {
    }

    public function createNewUser(string $name, $cpfCnpj): UsuarioAsaas|false
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/customers', [
                'body' => '{"name":"'.$name.'","cpfCnpj":"'.$cpfCnpj.'"}',
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => $this->asaasApikey,
                    'content-type' => 'application/json',
                ],
            ]);
            $jsonObj = json_decode($response->getBody(), null, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException|JsonException $e) {
            Log::error($e->getMessage());

            return false;
        }

        return UsuarioAsaas::fromJsonObject($jsonObj);
    }
}
