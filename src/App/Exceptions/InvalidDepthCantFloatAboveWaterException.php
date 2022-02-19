<?php

namespace App\Exceptions;

use Exception;

class InvalidDepthCantFloatAboveWaterException extends Exception
{
    public function __construct()
    {
        parent::__construct('Cant float above the sea level');
    }
}
