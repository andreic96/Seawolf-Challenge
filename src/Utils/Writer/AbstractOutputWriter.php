<?php

declare(strict_types=1);

namespace Utils\Writer;

abstract class AbstractOutputWriter implements OutputInterface
{
    public function write(string $message, bool $newline = false) : void
    {
        $this->doWrite($message, $newline);
    }

    public function writeln(string $message) : void
    {
        $this->doWrite($message, true);
    }

    abstract protected function doWrite(string $message, bool $newline);
}
