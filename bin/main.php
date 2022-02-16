#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Entity\Enemy;
use App\Entity\Torpedo;

$enemy = new Enemy();
$torpedoClassA = new Torpedo();
$torpedoClassB = new Torpedo();
$torpedoClassA->setDamagePoints(12);
$torpedoClassB->setDamagePoints(34);

$enemy->setWeapons([$torpedoClassA, $torpedoClassB]);

$weapons = $enemy->getWeapons();

foreach ($weapons as $weapon) {
    echo $weapon->getDamagePoints()."\n";
}
