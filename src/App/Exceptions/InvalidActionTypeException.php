<?php

namespace App\Exceptions;

use Exception;

class InvalidActionTypeException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Action type");
    }
}
