<?php

declare(strict_types=1);

namespace App\Entity;

class Torpedo
{
    /**
     * @var int
     */
    private $damagePoints;

    public function setDamagePoints(int $damagePoints) : void
    {
        $this->damagePoints = $damagePoints;
    }

    public function getDamagePoints() : int
    {
        return $this->damagePoints;
    }
}
