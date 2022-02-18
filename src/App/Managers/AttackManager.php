<?php

namespace App\Managers;

use App\Entities\Action;
use App\Entities\Enemy;
use App\Entities\InputData;
use App\Entities\Player;
use App\Exceptions\InvalidDepthCantFloatAboveWaterException;

class AttackManager
{
    /**
     * @throws InvalidDepthCantFloatAboveWaterException
     */
    public function doAction(Player $player, InputData $inputData) : int
    {
        $action = $player->getAction($inputData->getActionType());
        $depth = $this->calculateDepth($this->randomDistance($action), 1);

        if ($action->getType() === Action::ACTION_FLOAT) {
            return $player->float($depth);

        }

        return $player->dive($depth);
    }

    public function attack(Enemy $enemy, Player $player, InputData $inputData) : int
    {
        $randomCounterActionType = Action::randomActionType();

        if ($inputData->getActionType() !== $randomCounterActionType) {
            $randomDamagePoints = $this->randomDamagePoints($enemy);
            $player->addDamageTaken($randomDamagePoints);


            return $randomDamagePoints;
        }

        return 0;
    }

    private static function randomDistance(Action $action) : int
    {
        return rand($action->getMinValue(), $action->getMaxValue());
    }

    private static function calculateDepth(int $meters, int $multiplier) : int
    {
        return $meters * $multiplier;
    }

    private function randomDamagePoints(Enemy $enemy) : int
    {
        $torpedo = $enemy->getTorpedo();

        return rand($torpedo->getDamagePointsMin(), $torpedo->getDamagePointsMax());
    }
}
