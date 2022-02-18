<?php

namespace App\Exceptions;

use Exception;

class InvalidInputDepthOnlyException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Input, ypu can only dive first time. Ex: dive 300");
    }
}
