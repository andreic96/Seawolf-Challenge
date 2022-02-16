<?php

declare(strict_types=1);

namespace Utils\Output;

interface OutputInterface
{
    public function write(string $message, bool $newline = false);

    public function writeln(string $message);
}
