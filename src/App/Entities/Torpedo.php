<?php

declare(strict_types=1);

namespace App\Entities;

class Torpedo
{
    /**
     * @var int
     */
    private $damagePointsMin;

    /**
     * @var int
     */
    private $damagePointsMax;

    public function __construct(int $damagePointsMin, int $damagePointsMax){
       $this->setDamagePoints($damagePointsMin, $damagePointsMax);
    }

    public function setDamagePoints(int $damagePointsMin, int $damagePointsMax) : void
    {
        $this->damagePointsMin = min($damagePointsMin, $damagePointsMax);
        $this->damagePointsMax = max($damagePointsMin, $damagePointsMax);
    }

    public function getDamagePoints() : array
    {
        return [$this->damagePointsMin, $this->damagePointsMax];
    }

    public function getDamagePointsMin() : int
    {
        return $this->damagePointsMin;
    }

    public function getDamagePointsMax() : int
    {
        return $this->damagePointsMax;
    }
}
