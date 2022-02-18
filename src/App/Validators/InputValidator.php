<?php

namespace App\Validators;

use App\Entities\Action;
use App\Exceptions\InvalidActionInputException;
use App\Exceptions\InvalidActionTypeException;
use App\Exceptions\InvalidInputDepthOnlyException;
use App\Exceptions\InvalidInputException;

class InputValidator implements InputValidatorInterface
{
    public const SEA_MAX_LEVEL = 0;

    /**
     * @throws InvalidActionInputException
     * @throws InvalidActionTypeException
     */
    public static function validateActionInput(?string $actionInput) : void
    {
        if (!is_string($actionInput)) {
            throw new InvalidActionInputException();
        }

        if(!in_array($actionInput, Action::ACTIONS)) {
            throw new InvalidActionTypeException();
        }
    }

    /**
     * @throws InvalidInputDepthOnlyException
     */
    public static function validateAndReturnOnlyDepthInput(?string $depthInput) : array
    {
        if (!preg_match('/^\bdive\b \d+/', $depthInput, $depthMatched) || $depthMatched <= self::SEA_MAX_LEVEL) {
            throw new InvalidInputDepthOnlyException();
        }

        return $depthMatched;
    }

    /**
     * @throws InvalidInputException
     */
    public static function validateAndReturnInput(?string $input) : array
    {
        if (!preg_match('/\w+/', $input, $inputMatched)) {
            throw new InvalidInputException();
        }

        return $inputMatched;
    }
}
