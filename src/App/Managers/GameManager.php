<?php

namespace App\Managers;

use Utils\Input\InputInterface;
use Utils\Output\OutputInterface;

class GameManager
{
    /** @var InputInterface  */
    private $input;

    /** @var OutputInterface */
    private $output;

    private function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function test()
    {

    }
}
