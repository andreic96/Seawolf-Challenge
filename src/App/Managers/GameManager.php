<?php

namespace App\Managers;

use App\Entities\Action;
use App\Entities\Enemy;
use App\Entities\InputData;
use App\Entities\Location;
use App\Entities\Player;
use App\Entities\Torpedo;
use App\Exceptions\InvalidActionTypeException;
use App\Exceptions\InvalidDepthCantFloatAboveWaterException;
use App\Exceptions\InvalidDepthOutOfRangeException;
use App\Exceptions\InvalidInputDepthOnlyException;
use App\Exceptions\InvalidInputException;
use App\Validators\InputValidatorInterface;
use Utils\Input\InputInterface;
use Utils\Output\OutputInterface;

class GameManager
{
    //TODO replace this
    private const ENEMY_NUMBER = 3;

    /** @var InputInterface  */
    private $input;

    /** @var OutputInterface */
    private $output;

    /** @var InputValidatorInterface */
    private $inputValidator;

    /** @var AttackManager */
    private $attackManager;

    /** @var InputData */
    private $inputData;

    /** @var int */
    private $turn = 0;

    public function __construct(
        InputInterface $input,
        OutputInterface $output,
        InputValidatorInterface $inputValidator,
        AttackManager $attackManager
    ) {
        $this->input = $input;
        $this->output = $output;
        $this->inputValidator = $inputValidator;
        $this->attackManager = $attackManager;
    }

    public function run() : void
    {
        $this->displayWelcomeMessages();

        $actions = [];
        try {
            $actionFloat = new Action(Action::ACTION_FLOAT, 1, 45);
            $actionDive = new Action(Action::ACTION_DIVE, 5, 75);
            $actions = [$actionFloat, $actionDive];
        } catch (InvalidActionTypeException $e) {
            $this->output->writeError($e->getMessage());
        }

        $player = new Player($actions);

        $weaponEnemyW = new Torpedo(1, 5);
        $locationEnemyW = new Location(Location::WEST);
        $enemyW = new Enemy($weaponEnemyW, $locationEnemyW);

        $weaponEnemyE = new Torpedo(7, 14);
        $locationEnemyE = new Location(Location::EAST);
        $enemyE = new Enemy($weaponEnemyE, $locationEnemyE);

        $weaponEnemyN = new Torpedo(9, 22);
        $locationEnemyN = new Location(Location::NORTH);
        $enemyN = new Enemy($weaponEnemyN, $locationEnemyN);

        $enemies = [$enemyW, $enemyE, $enemyN];

        $inputLine = $this->input->getLine();
        $this->inputData = $this->getInputDataDepth($inputLine);
        $player->dive($this->inputData->getActionDepth());

        // Game loop
        while ($this->turn < count($enemies)) {
            try {
                $this->displayTurnMessages($player);

                /** @var Enemy $currentEnemy */
                $currentEnemy = $enemies[$this->turn];

                $this->output->writeInfo(sprintf('You are being hit from the %s with a missile, what is your action, Captain ?', $currentEnemy->getLocation()));

                $inputLine = $this->input->getLine();
                $this->inputData = $this->getInputData($inputLine);
                $this->inputValidator::validateActionInput($this->inputData->getActionType());

                $this->attackManager->doAction($player, $this->inputData);
                $damageDealt = $this->attackManager->attack($currentEnemy, $player, $this->inputData);
                if ($damageDealt) {
                    //TODO get depth float/dive
                    $this->output->writeWarning(sprintf('Incorrect :( You’ve taken %s damage points, diving %sm', $damageDealt, 1));
                } else {
                    //TODO get depth float/dive
                    $this->output->writeSuccess(sprintf('Correct ! You dodged the hit, diving %sm.', 1));
                }

                $this->turn++;
            } catch (
                InvalidInputException | InvalidInputDepthOnlyException |
                InvalidActionTypeException | InvalidDepthOutOfRangeException |
                InvalidDepthCantFloatAboveWaterException $e
            ) {
                $this->output->writeError($e->getMessage());
            }
        }

        $this->output->writeInfo(sprintf('Final depth: %s', $player->getCurrentDepth()));
        $this->output->writeInfo(sprintf('Damage taken: %s', $player->getDamageTaken()));
    }

    private function displayWelcomeMessages() : void
    {
        $this->output->writeSuccess('Ahoy! Welcome aboard of USS Nautilus! Currently located at 42°40\'04.4"N 175°35\'28.3”W');
        $this->output->writeInfo(sprintf('Your sonar has detected %s enemy submarines coming at you!', self::ENEMY_NUMBER));
        $this->output->writeInfo('Take evasive actions to save your ship! Your first action is to dive. Please input the depth in meters (any depth):');
    }

    private function displayTurnMessages(Player $player) : void
    {
        $this->output->writeInfo(sprintf('Your current depth is %s', $player->getCurrentDepth()));
    }

    private function getInputDataDepth(string $inputLine) : InputData
    {
        $matchesInputFormat = $this->inputValidator::validateAndReturnOnlyDepthInput($inputLine);
        $inputParts = explode(' ', $matchesInputFormat[0]);

        return new InputData($inputParts[0], $inputParts[1]);
    }

    private function getInputData(string $inputLine) : InputData
    {
        $matchesInputFormat = $this->inputValidator::validateAndReturnInput($inputLine);
        $inputParts = explode(' ', $matchesInputFormat[0]);

        return new InputData($inputParts[0]);
    }
}
