<?php

namespace App\Exceptions;

use Exception;

class InvalidInputException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Input, format should be: action depth.\nEx: dive 300");
    }
}
