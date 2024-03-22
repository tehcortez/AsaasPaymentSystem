<?php

namespace App\Services\CobrancaAsaasService;

class AsaasApiErrorList
{
    /*
     * @var list<AsaasApiError>
     */
    private array $list;

    private function __construct(AsaasApiError ...$asaasApiError)
    {
        $this->list = $asaasApiError;
    }

    public function getAsaasApiErrorList(): array
    {
        return $this->list;
    }

    public static function create(object $jsonObj): self
    {
        $asaasApiErrorList = [];
        foreach ($jsonObj->errors as $error) {
            $asaasApiErrorList[] = AsaasApiError::fromJsonObject($error);
        }

        return new self(...$asaasApiErrorList);
    }
}
