<?php

namespace App\Services;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Config;

class AsaasServiceFactory
{
    public function getAsaasService(string $fullyQualifiedClassName): AsaasServiceInterface
    {
        $saasApikey = Config::get('app.asaas_apikey');
        switch ($fullyQualifiedClassName) {
            case CobrancaAsaasService::class:
                return new CobrancaAsaasService($saasApikey);
            case UsuarioAsaasService::class:
                return new UsuarioAsaasService($saasApikey);
            case PixAsaasService::class:
                return new PixAsaasService($saasApikey);
            default:
                throw new InvalidArgumentException('Class not found');
        }

    }
}
