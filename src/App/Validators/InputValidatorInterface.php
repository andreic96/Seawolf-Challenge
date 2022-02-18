<?php

namespace App\Validators;

use App\Entities\InputData;

interface InputValidatorInterface
{
    public static function validateActionInput(?string $actionInput) : void;

    public static function validateAndReturnOnlyDepthInput(?string $depthInput) : array;

    public static function validateAndReturnInput(?string $input) : array;
}
