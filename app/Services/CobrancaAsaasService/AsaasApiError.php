<?php

namespace App\Services\CobrancaAsaasService;

readonly class AsaasApiError
{
    private function __construct(
        public string $code,
        public string $description
    ) {
    }

    public static function fromJsonObject(object $jsonObj): self
    {
        return new self(
            $jsonObj->code,
            $jsonObj->description
        );
    }

    public static function create(string $code, string $description): self {
        return new self(
            $code,
            $description
        );
    }
}
