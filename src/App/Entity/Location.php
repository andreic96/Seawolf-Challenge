<?php

namespace App\Entity;

use App\Exceptions\InvalidCardinalPointException;

class Location
{
    public const NORTH = 'N';
    public const NORTHEAST = 'NE';
    public const EAST = 'E';
    public const SOUTHEAST = 'SE';
    public const SOUTH = 'S';
    public const SOUTHWEST = 'SW';
    public const WEST = 'W';
    public const NORTHWEST = 'NW';

    public const CARDINAL_POINTS = [
        self::NORTH => 'North',
        self::NORTHEAST => 'North-East',
        self::EAST => 'East',
        self::SOUTHEAST => 'South-East',
        self::SOUTH => 'South',
        self::SOUTHWEST => 'South-West',
        self::WEST => 'West',
        self::NORTHWEST => 'North-West',
    ];

    private const UNKNOWN_LOCATION = 'Unknown location';
    private const ERROR_LOCATION = 'No such location!';

    /** @var string */
    public $cardinalPoint;

    /**
     * @throws InvalidCardinalPointException
     */
    public function __construct(string $cardinalPoint)
    {
        $this->setCardinalPoint($cardinalPoint);
    }

    public function __toString()
    {
        return self::CARDINAL_POINTS[$this->cardinalPoint] ?? self::UNKNOWN_LOCATION;
    }

    /**
     * @throws InvalidCardinalPointException
     */
    public function setCardinalPoint(string $cardinalPoint) : void
    {
        if (self::isValidCardinalPoint($cardinalPoint)) {
            $this->cardinalPoint = $cardinalPoint;
        } else {
            throw new InvalidCardinalPointException(self::ERROR_LOCATION);
        }
    }

    public function getCardinalPoint() : ?string
    {
        return $this->cardinalPoint;
    }

    private static function isValidCardinalPoint(string $cardinalPoint) : bool
    {
       return array_key_exists($cardinalPoint, self::CARDINAL_POINTS);
    }
}
