<?php

namespace App\Validators;

interface InputValidatorInterface
{
    public static function validateActionInput(?string $actionInput) : void;

    public static function validateDepthInput(?string $depthInput) : void;

    public static function validateOnlyDepthInput(?string $actionInput) : void;

    public static function validateInput(?string $input) : void;
}
