<?php

namespace App\Validators;

use App\Exceptions\InvalidActionInputException;
use App\Exceptions\InvalidDepthInputException;
use App\Exceptions\InvalidInputDepthOnlyException;
use App\Exceptions\InvalidInputException;

class InputValidator implements InputValidatorInterface
{
    private const SEA_MAX_LEVEL = 0;

    /**
     * @throws InvalidActionInputException
     */
    public static function validateActionInput(?string $actionInput) : void
    {
        if (!is_string($actionInput)) {
            throw new InvalidActionInputException();
        }
    }

    /**
     * @throws InvalidDepthInputException
     */
    public static function validateDepthInput(?string $depthInput) : void
    {
        if (!is_numeric($depthInput) || $depthInput <= 0) {
            throw new InvalidDepthInputException();
        }
    }

    /**
     * @throws InvalidInputDepthOnlyException
     */
    public static function validateOnlyDepthInput(?string $depthInput) : void
    {
        if (!preg_match('/^\d+/', $depthInput, $depth) || $depth <= self::SEA_MAX_LEVEL) {
            throw new InvalidInputDepthOnlyException();
        }
    }

    /**
     * @throws InvalidInputException
     */
    public static function validateInput(?string $input) : void
    {
        if (!preg_match('/\w+ \d+/', $input)) {
            throw new InvalidInputException();
        }
    }
}
