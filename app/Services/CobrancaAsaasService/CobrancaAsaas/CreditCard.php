<?php

namespace App\Services\CobrancaAsaasService\CobrancaAsaas;

use App\Services\CobrancaAsaasService\CobrancaAsaas;
use App\Services\CobrancaAsaasService\Exception\AsaasDateException;
use DateTimeImmutable;
use Exception;
use Illuminate\Support\Facades\Log;

readonly class CreditCard extends CobrancaAsaas
{
    private function __construct(
        string $id,
        string $billingType,
        int $value,
        DateTimeImmutable $dueDate
    ) {
        parent::__construct($id, $billingType, $value, $dueDate);
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
        );
    }

    /*
    REQUEST:
    curl --request POST \
         --url https://sandbox.asaas.com/api/v3/payments/ \
         --header 'accept: application/json' \
         --header 'access_token: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzY1ODU6OiRhYWNoXzllNzljOWZjLTFkNDQtNDg0MS04NWQ1LTMxOWRkZmE4ZjNiMw==' \
         --header 'content-type: application/json' \
         --data '
    {
      "billingType": "CREDIT_CARD",
      "creditCard": {
        "holderName": "john doe",
        "number": "5162306219378829",
        "expiryMonth": "05",
        "expiryYear": "2025",
        "ccv": "318"
      },
      "creditCardHolderInfo": {
        "name": "John Doe",
        "email": "john.doe@asaas.com.br",
        "cpfCnpj": "24971563792",
        "postalCode": "89223-005",
        "addressNumber": "277",
        "addressComplement": null,
        "phone": "4738010919",
        "mobilePhone": "47998781877"
      },
      "customer": "cus_000005928466",
      "dueDate": "2024-08-30",
      "value": 100
    }
    '

    RESPONSE:
    {
      "object": "payment",
      "id": "pay_gaeuruylq0fl7m1p",
      "dateCreated": "2024-03-18",
      "customer": "cus_000005928466",
      "paymentLink": null,
      "value": 100,
      "netValue": 97.52,
      "originalValue": null,
      "interestValue": null,
      "description": null,
      "billingType": "CREDIT_CARD",
      "confirmedDate": "2024-03-18",
      "creditCard": {
        "creditCardNumber": "8829",
        "creditCardBrand": "MASTERCARD",
        "creditCardToken": "0a6bc1f5-9827-4d10-8329-5a3e6624998c"
      },
      "pixTransaction": null,
      "status": "CONFIRMED",
      "dueDate": "2024-08-30",
      "originalDueDate": "2024-08-30",
      "paymentDate": null,
      "clientPaymentDate": "2024-03-18",
      "installmentNumber": null,
      "invoiceUrl": "https://sandbox.asaas.com/i/gaeuruylq0fl7m1p",
      "invoiceNumber": "05305647",
      "externalReference": null,
      "deleted": false,
      "anticipated": false,
      "anticipable": false,
      "creditDate": "2024-04-19",
      "estimatedCreditDate": "2024-04-19",
      "transactionReceiptUrl": "https://sandbox.asaas.com/comprovantes/0255314208471659",
      "nossoNumero": null,
      "bankSlipUrl": null,
      "lastInvoiceViewedDate": null,
      "lastBankSlipViewedDate": null,
      "postalService": false,
      "custody": null,
      "refunds": null
    }

    ERROR_RESPONSE:
    {
      "errors": [
        {
          "code": "invalid_action",
          "description": "Transação não autorizada. Verifique os dados do cartão de crédito e tente novamente."
        }
      ]
    }

    PHP:
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/payments/', [
      'body' => '{"billingType":"CREDIT_CARD","creditCard":{"holderName":"john doe","number":"5162306219378829","expiryMonth":"05","expiryYear":"2025","ccv":"318"},"creditCardHolderInfo":{"name":"John Doe","email":"john.doe@asaas.com.br","cpfCnpj":"24971563792","postalCode":"89223-005","addressNumber":"277","addressComplement":null,"phone":"4738010919","mobilePhone":"47998781877"},"customer":"cus_000005928466","dueDate":"2024-08-30","value":100}',
      'headers' => [
        'accept' => 'application/json',
        'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzY1ODU6OiRhYWNoXzllNzljOWZjLTFkNDQtNDg0MS04NWQ1LTMxOWRkZmE4ZjNiMw==',
        'content-type' => 'application/json',
      ],
    ]);

    echo $response->getBody();
     */
}
