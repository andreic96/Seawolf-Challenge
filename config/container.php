<?php

use App\Validators\InputValidator;
use App\Validators\InputValidatorInterface;
use DI\Container;
use Utils\Input\ConsoleInput;
use Utils\Input\InputInterface;
use Utils\Output\ConsoleOutput;
use Utils\Output\OutputInterface;

$container = new Container();

$container->set(InputInterface::class, DI\create(ConsoleInput::class));
$container->set(OutputInterface::class, DI\create(ConsoleOutput::class));
$container->set(InputValidatorInterface::class, DI\create(InputValidator::class));

return $container;
