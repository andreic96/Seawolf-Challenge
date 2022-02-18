<?php

declare(strict_types=1);

namespace App\Entities;

use App\Exceptions\InvalidDepthCantFloatAboveWaterException;

class Player implements ActionableInterface
{
    /**
     * @var int
     */
    private $currentDepth = 0;

    /**
     * @var array
     */
    private $actions = [];

    /**
     * @var int
     */
    private $damageTaken = 0;

    public function __construct(array $actions)
    {
        $this->setActions($actions);
    }

    public function getCurrentDepth() : int
    {
        return $this->currentDepth;
    }

    public function setCurrentDepth(int $currentDepth) : void
    {
        $this->currentDepth = $currentDepth;
    }

    public function getActions() : array
    {
        return $this->actions;
    }

    public function getAction(string $actionType) : Action
    {
        return $this->actions[$actionType];
    }

    public function setActions(array $actions) : void
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }
    }

    public function addAction(Action $action) : void
    {
        $this->actions[$action->getType()] = $action;
    }

    public function getDamageTaken() : int
    {
        return $this->damageTaken;
    }

    public function setDamageTaken(int $damageTaken) : void
    {
        $this->damageTaken = $damageTaken;
    }

    public function addDamageTaken(int $damageTaken) : void
    {
        $this->damageTaken += $damageTaken;
    }

    public function dive(int $distance) : int
    {
        $this->currentDepth += $distance;

        return $distance;
    }

    /**
     * @throws InvalidDepthCantFloatAboveWaterException
     */
    public function float(int $distance) : int
    {
        if ($this->currentDepth == 0 || $this->currentDepth + $distance <= 0) {
            throw new InvalidDepthCantFloatAboveWaterException();
        }

        $this->currentDepth += $distance;

        return $distance;
    }
}
