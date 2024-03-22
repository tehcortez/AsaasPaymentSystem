<?php

namespace App\Services\CobrancaAsaasService\Exception;

use Exception;

class AsaasDateException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid_date_Asaas');
    }
}
