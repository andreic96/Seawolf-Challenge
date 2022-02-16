<?php

declare(strict_types=1);

namespace App\Entity;

class Enemy
{
    /**
     * @var array
     */
    private $weapons = [];

    /**
     * @var string
     */
    private $location;

    public function addWeapon(Torpedo $weapon) : void
    {
        $this->weapons[] = $weapon;
    }

    public function setWeapons(array $weapons) : void
    {
        $this->weapons = $weapons;
    }

    public function getWeapons() : array
    {
        return $this->weapons;
    }

    public function setLocation(Location $location) : void
    {
        $this->location = $location;
    }

    public function getLocation() : string
    {
        return $this->location;
    }
}
