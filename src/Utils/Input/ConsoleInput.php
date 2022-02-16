<?php

declare(strict_types=1);

namespace Utils\Input;

class ConsoleInput implements InputInterface
{
    /** @var resource */
    private $stream;

    public function __construct()
    {
        $this->stream = $this->openInputStream();
    }

    public function getLine() : ?string
    {
        $line = fgets($this->stream);
        return $line ? trim($line) : null;
    }

    /** @return resource */
    private function openInputStream()
    {
        return fopen('php://stdin', 'r');
    }
}
