<?php

namespace App\Entities;

class Attack
{
    /** @var Player */
    private $player;

    /** @var Enemy */
    private $enemy;

    /** @var int */
    private $turnNumber;

    /** @var int */
    private $damageMultiplier = 1;

    /** @var int */
    private $damageDealt = 0;

    /** @var int */
    private $depthDived;

    /** @var Action */
    private $action;

    public function __construct(Player $player, Enemy $enemy, int $turnNumber)
    {
        $this->setPlayer($player);
        $this->setEnemy($enemy);
        $this->setTurnNumber($turnNumber);
    }

    public function setPlayer(Player $player) : void
    {
        $this->player = $player;
    }

    public function getPlayer() : Player
    {
        return $this->player;
    }

    public function setEnemy(Enemy $enemy) : void
    {
        $this->enemy = $enemy;
    }

    public function getEnemy() : Enemy
    {
        return $this->enemy;
    }

    public function setTurnNumber(int $turnNumber) : void
    {
        $this->turnNumber = $turnNumber;
    }

    public function getTurnNumber() : int
    {
        return $this->turnNumber;
    }

    public function setDamageMultiplier(int $damageMultiplier) : void
    {
        $this->damageMultiplier = $damageMultiplier;
    }

    public function getDamageMultiplier() : int
    {
        return $this->damageMultiplier;
    }

    public function setDamageDealt(int $damageDealt) : void
    {
        $this->damageDealt = $damageDealt;
    }

    public function getDamageDealt() : int
    {
        return $this->damageDealt;
    }

    public function hasDamageDealt() : bool
    {
        return (bool)$this->damageDealt;
    }

    public function setDepthDived(int $depthDived) : void
    {
        $this->depthDived = $depthDived;
    }

    public function getDepthDived() : int
    {
        return $this->depthDived;
    }

    public function setAction(Action $action) : void
    {
        $this->action = $action;
    }

    public function getAction() : Action
    {
        return $this->action;
    }
}
