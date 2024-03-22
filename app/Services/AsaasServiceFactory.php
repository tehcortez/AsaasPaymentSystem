<?php

namespace App\Services;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Config;

class AsaasServiceFactory
{
    public function getAsaasService(string $fullyQualifiedClassName): AsaasServiceInterface
    {
        $saasApikey = Config::get('app.asaas_apikey');
        return match ($fullyQualifiedClassName) {
            CobrancaAsaasService::class => new CobrancaAsaasService($saasApikey),
            UsuarioAsaasService::class => new UsuarioAsaasService($saasApikey),
            PixAsaasService::class => new PixAsaasService($saasApikey),
            default => throw new InvalidArgumentException('Class not found'),
        };
    }
}
