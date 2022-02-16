<?php

namespace App\Managers;

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

    /** @var int */
    private $turn = 0;

    public function __construct(
        InputInterface $input,
        OutputInterface $output,
        InputValidatorInterface $inputValidator
    ) {
        $this->input = $input;
        $this->output = $output;
        $this->inputValidator = $inputValidator;
    }

    public function run() : void
    {
        $this->displayWelcomeMessages();

        // Game loop
        while (true) {
            try {
                if ($this->turn === 0) {
                    $this->inputValidator::validateOnlyDepthInput($this->input->getLine());
                } else {
                    $this->inputValidator::validateInput($this->input->getLine());
                }
                $this->turn++;
            } catch (InvalidInputException | InvalidInputDepthOnlyException $e) {
                $this->output->writeError($e->getMessage());
            }
        }
    }

    private function displayWelcomeMessages() : void
    {
        $this->output->writeSuccess('Ahoy! Welcome aboard of USS Nautilus! Currently located at 42°40\'04.4"N 175°35\'28.3”W');
        $this->output->writeInfo(sprintf('Your sonar has detected %s enemy submarines coming at you!', self::ENEMY_NUMBER));
        $this->output->writeInfo('Take evasive actions to save your ship! Your first action is to dive. Please input the depth in meters (any depth):');
    }
}
