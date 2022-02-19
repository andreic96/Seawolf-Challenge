<?php

namespace App\Managers;

use App\Entities\Action;
use App\Entities\Attack;
use App\Entities\Enemy;
use App\Entities\InputData;
use App\Exceptions\InvalidDepthCantFloatAboveWaterException;
use Utils\Output\OutputInterface;

class AttackManager
{
    /**
     * @throws InvalidDepthCantFloatAboveWaterException
     */
    public function doAction(Attack $attack, InputData $inputData) : void
    {
        $player = $attack->getPlayer();
        $action = $player->getAction($inputData->getActionType());
        $randomDepth = $this->randomDepth($action);

        $attack->setDepthDived($randomDepth);
        $attack->setAction($action);
        if ($action->getType() === Action::ACTION_FLOAT) {
            $player->float($randomDepth);
        } else {
            $player->dive($randomDepth);
        }
    }

    public function attack(Attack $attack, InputData $inputData) : void
    {
        $randomCounterActionType = Action::randomActionType();

        if ($inputData->getActionType() !== $randomCounterActionType) {
            $randomDamagePoints = $this->randomDamagePoints($attack->getEnemy());

            $attack->getPlayer()->addDamageTaken($randomDamagePoints);
            $attack->setDamageDealt($randomDamagePoints);
        }
    }

    public function displayDamageDealtMessage(Attack $attack, OutputInterface $output) : void
    {
        if ($attack->hasDamageDealt()) {
            $output->writeWarning(sprintf(
                'Incorrect :( You’ve taken %s damage points, %s %sm',
                $attack->getDamageDealt(),
                $attack->getAction()->getType(),
                $attack->getDepthDived()
            ));
        } else {
            $output->writeSuccess(sprintf(
                'Correct ! You dodged the hit, %s %sm.',
                $attack->getAction()->getType(),
                $attack->getDepthDived()
            ));
        }
    }

    private static function randomDepth(Action $action) : int
    {
        return rand($action->getMinValue(), $action->getMaxValue());
    }

    private function randomDamagePoints(Enemy $enemy) : int
    {
        $torpedo = $enemy->getTorpedo();

        return rand($torpedo->getDamagePointsMin(), $torpedo->getDamagePointsMax());
    }
}
