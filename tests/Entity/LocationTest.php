<?php

declare(strict_types=1);

namespace Entity;

use App\Entities\Location;
use App\Exceptions\InvalidCardinalPointException;
use Test\TestCase;

/** @covers Location */
class LocationTest extends TestCase
{
    public function testNewLocationThrowsInvalidCardinalPointException(): void
    {
        $this->expectException(InvalidCardinalPointException::class);
        $this->expectErrorMessage('No such location!');

        new Location('NS');
    }

    public function testSetCardinalPointThrowsInvalidCardinalPointException(): void
    {
        $location = new Location('N');
        $this->expectException(InvalidCardinalPointException::class);
        $this->expectErrorMessage('No such location!');

        $location->setCardinalPoint('NS');
    }

    public function testGetCardinalPoint(): void
    {
        $location = new Location('NE');

        $this->assertEquals('NE', $location->getCardinalPoint());
    }

    public function testIsValidCardinalPoint(): void
    {
        $location = new Location('NE');

        $this->assertTrue($this->invokeMethod($location, 'isValidCardinalPoint', ['N']));
        $this->assertTrue($this->invokeMethod($location, 'isValidCardinalPoint', ['NE']));
        $this->assertTrue($this->invokeMethod($location, 'isValidCardinalPoint', ['SW']));
        $this->assertFalse($this->invokeMethod($location, 'isValidCardinalPoint', ['NS']));
        $this->assertFalse($this->invokeMethod($location, 'isValidCardinalPoint', ['']));
        $this->assertFalse($this->invokeMethod($location, 'isValidCardinalPoint', ['.']));
    }

    public function testToStringCardinalPoint(): void
    {
        $location = new Location('NE');
        $this->assertEquals('North-East', $location);
    }

}
