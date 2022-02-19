<?php

namespace App\Entities;

class Game
{
    /** @var array */
    private $attacks;

    /** @var array */
    private $enemies;

    public function setAttacks(array $attacks) : void
    {
        $this->attacks = $attacks;
    }

    public function addAttack(Attack $attack) : void
    {
        $this->attacks[] = $attack;
    }

    public function getAttacks() : array
    {
        return $this->attacks;
    }

    public function getAttack(int $turn) : ?Attack
    {
        return $this->attacks[$turn] ?? null;
    }

    public function setEnemies(array $enemies) : void
    {
        $this->enemies = $enemies;
    }

    public function addEnemy(Enemy $enemy) : void
    {
        $this->enemies[] = $enemy;
    }

    public function getEnemies() : array
    {
        return $this->enemies;
    }
}
