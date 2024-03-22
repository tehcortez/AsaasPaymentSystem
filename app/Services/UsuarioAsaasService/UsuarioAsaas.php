<?php

namespace App\Services\UsuarioAsaasService;

readonly class UsuarioAsaas implements UsuarioAsaasInterface
{
    private function __construct(
        private string $id,
        private string $name,
        private string $cpfCnpj,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public static function fromJsonObject(object $jsonObj): self
    {
        return new self(
            $jsonObj->id,
            $jsonObj->name,
            $jsonObj->cpfCnpj,
        );
    }

    /*
    REQUEST:
    curl --request POST \
         --url https://sandbox.asaas.com/api/v3/customers \
         --header 'accept: application/json' \
         --header 'access_token: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzY1ODU6OiRhYWNoXzllNzljOWZjLTFkNDQtNDg0MS04NWQ1LTMxOWRkZmE4ZjNiMw==' \
         --header 'content-type: application/json' \
         --data '
    {
      "name": "John Doe",
      "cpfCnpj": "24971563792"
    }
    '

    RESPONSE:

    {
      "object": "customer",
      "id": "cus_000005928466",
      "dateCreated": "2024-03-18",
      "name": "John Doe",
      "email": null,
      "company": null,
      "phone": null,
      "mobilePhone": null,
      "address": null,
      "addressNumber": null,
      "complement": null,
      "province": null,
      "postalCode": null,
      "cpfCnpj": "24971563792",
      "personType": "FISICA",
      "deleted": false,
      "additionalEmails": null,
      "externalReference": null,
      "notificationDisabled": false,
      "observations": null,
      "municipalInscription": null,
      "stateInscription": null,
      "canDelete": true,
      "cannotBeDeletedReason": null,
      "canEdit": true,
      "cannotEditReason": null,
      "city": null,
      "state": null,
      "country": "Brasil"
    }

    PHP:
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/customers', [
      'body' => '{"name":"John Doe","cpfCnpj":"24971563792"}',
      'headers' => [
        'accept' => 'application/json',
        'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzY1ODU6OiRhYWNoXzllNzljOWZjLTFkNDQtNDg0MS04NWQ1LTMxOWRkZmE4ZjNiMw==',
        'content-type' => 'application/json',
      ],
    ]);

    echo $response->getBody();
     */
}
