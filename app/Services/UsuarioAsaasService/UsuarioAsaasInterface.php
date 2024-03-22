<?php

namespace App\Services\UsuarioAsaasService;

interface UsuarioAsaasInterface
{
    public function getId(): string;

    public function getName(): string;

    public function getCpfCnpj(): string;
}
