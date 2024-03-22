<?php

namespace App\Services;

use App\Services\CobrancaAsaasService\AsaasApiErrorList;
use App\Services\CobrancaAsaasService\CobrancaAsaas;
use App\Services\CobrancaAsaasServiceDto\CreditCardAsaasDto;
use App\Services\CobrancaAsaasServiceDto\CreditCardHolderInfoAsaasDto;
use DateTimeImmutable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use JsonException;

readonly class CobrancaAsaasService implements AsaasServiceInterface
{
    public function __construct(
        private string $asaasApikey
    ) {
    }

    public function createNewCobranca(
        string $billingType,
        string $asaasCustomerId,
        int $value,
        DateTimeImmutable $dueDate,
        ?CreditCardAsaasDto $creditCardAsaasDto = null,
        ?CreditCardHolderInfoAsaasDto $creditCardHolderInfoAsaasDto = null,
    ): CobrancaAsaas|AsaasApiErrorList|false {
        $client = new Client();

        $body = $this->getRequestBody(
            $billingType,
            $asaasCustomerId,
            $value,
            $dueDate,
            $creditCardAsaasDto,
            $creditCardHolderInfoAsaasDto
        );

        try {
            $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/payments', [
                'body' => $body,
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => $this->asaasApikey,
                    'content-type' => 'application/json',
                ],
            ]);
            $jsonObj = json_decode($response->getBody(), null, 512, JSON_THROW_ON_ERROR);
        } catch (ClientException $e) {
            Log::error($e->getMessage());
            $jsonObj = json_decode($e->getResponse()->getBody());

            return AsaasApiErrorList::create($jsonObj);
        } catch (GuzzleException|JsonException $e) {
            Log::error($e->getMessage());

            return false;
        }

        return CobrancaAsaas::fromJsonObject($jsonObj);
    }

    private function getRequestBody(
        string $billingType,
        string $asaasCustomerId,
        int $value,
        DateTimeImmutable $dueDate,
        ?CreditCardAsaasDto $creditCardAsaasDto = null,
        ?CreditCardHolderInfoAsaasDto $creditCardHolderInfoAsaasDto = null,
    ): string {
        if ($billingType === 'CREDIT_CARD') {
            return json_encode([
                'billingType' => $billingType,
                'customer' => $asaasCustomerId,
                'value' => $value,
                'dueDate' => $dueDate->format('Y-m-d'),
                'creditCard' => $creditCardAsaasDto->toArray(),
                'creditCardHolderInfo' => $creditCardHolderInfoAsaasDto->toArray(),
            ]);
        }

        return json_encode([
            'billingType' => $billingType,
            'customer' => $asaasCustomerId,
            'value' => $value,
            'dueDate' => $dueDate->format('Y-m-d'),
        ]);
    }
}
