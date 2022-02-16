<?php

namespace App\Exceptions;

use Exception;

class InvalidInputDepthOnlyException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Input, insert only a positive depth first time");
    }
}
