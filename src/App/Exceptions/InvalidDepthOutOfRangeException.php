<?php

namespace App\Exceptions;

use Exception;

class InvalidDepthOutOfRangeException extends Exception
{
    public function __construct()
    {
        parent::__construct('Depth is out of range');
    }
}
