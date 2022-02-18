<?php

declare(strict_types=1);

namespace App\Entities;

class Enemy
{
    /**
     * @var Torpedo
     */
    private $torpedo;

    /**
     * @var string
     */
    private $location;

    public function __construct(Torpedo $torpedo, Location $location)
    {
        $this->torpedo = $torpedo;
        $this->location = $location;
    }

    public function setTorpedo(array $torpedo) : void
    {
        $this->torpedo = $torpedo;
    }

    public function getTorpedo() : Torpedo
    {
        return $this->torpedo;
    }

    public function setLocation(Location $location) : void
    {
        $this->location = $location;
    }

    public function getLocation() : Location
    {
        return $this->location;
    }
}
