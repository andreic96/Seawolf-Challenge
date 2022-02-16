<?php

declare(strict_types=1);

namespace App\Entity;

class Submarine
{
    /**
     * @var int
     */
    private $currentLevel = 0;

    public function getCurrentLevel() : int
    {
        return $this->currentLevel;
    }

    public function setCurrentLevel(int $currentLevel) : void
    {
        $this->currentLevel = $currentLevel;
    }
}
