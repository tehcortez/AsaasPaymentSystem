<?php

namespace App\Services\PixAsaasService;

readonly class PixQrCodeAsaas
{
    private function __construct(
        private string $encodedImage,
        private string $payload,
    ) {
    }

    public function getEncodedImage(): string
    {
        return $this->encodedImage;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public static function fromJsonObject(object $jsonObj): self
    {
        return new self(
            $jsonObj->encodedImage,
            $jsonObj->payload,
        );
    }

    public static function createEmpty(): self
    {
        return new self(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=',
            '',
        );
    }
}
