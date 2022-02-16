<?php

namespace Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use ReflectionClass;

class TestCase extends PHPUnitTestCase
{
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
