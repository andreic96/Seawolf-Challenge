<?php

namespace App\Exceptions;

use Exception;

class InvalidActionInputException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid Action Input');
    }
}
