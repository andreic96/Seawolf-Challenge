#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Managers\GameManager;

require __DIR__ . '/../vendor/autoload.php';
$container = require __DIR__ . '/../config/container.php';

/** @var GameManager $gameManager */
$gameManager = $container->get(GameManager::class);
$gameManager->run();
