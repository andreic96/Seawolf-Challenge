<?php

namespace App\Entities;

interface ActionableInterface
{
    public function float(int $distance) : void;

    public function dive(int $distance) : void;
}
