<?php

namespace App\Services;

use App\Services\UsuarioAsaasService\UsuarioAsaas;

interface UsuarioAsaasServiceInterface
{
    public function createNewUser(string $name, $cpfCnpj): UsuarioAsaas|false;
}
