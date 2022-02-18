<?php

namespace App\Entities;

interface ActionableInterface
{
    public function float(int $distance) : int;

    public function dive(int $distance) : int;
}
