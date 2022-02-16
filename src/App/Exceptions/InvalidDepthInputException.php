<?php

namespace App\Exceptions;

use Exception;

class InvalidDepthInputException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid Depth Input');
    }
}
