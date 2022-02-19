<?php

declare(strict_types=1);

namespace App\Entities;

use App\Exceptions\InvalidActionTypeException;

class Action
{
    public const ACTION_FLOAT = 'float';
    public const ACTION_DIVE = 'dive';

    public const ACTIONS = [
        self::ACTION_FLOAT,
        self::ACTION_DIVE,
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $minValue;

    /**
     * @var int
     */
    private $maxValue;

    /**
     * @throws InvalidActionTypeException
     */
    public function __construct(string $type, int $minValue, int $maxValue)
    {
        $this->setType($type);
        $this->setValues($minValue, $maxValue);
    }

    /**
     * @throws InvalidActionTypeException
     */
    public function setType(string $type) : void
    {
        if (!in_array($type, self::ACTIONS)) {
            throw new InvalidActionTypeException();
        }

        $this->type = $type;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getMinValue() : int
    {
        return $this->minValue;
    }

    public function getMaxValue() : int
    {
        return $this->maxValue;
    }

    public function setValues(int $minValue, int $maxValue) : void
    {
        $this->minValue = min($minValue, $maxValue);
        $this->maxValue = max($minValue, $maxValue);
    }

    public static function randomActionType() : string
    {
        $randomKey = array_rand(self::ACTIONS);
        return self::ACTIONS[$randomKey];
    }
}
