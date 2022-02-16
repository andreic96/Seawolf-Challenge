<?php

declare(strict_types=1);

namespace Utils\Output;

class ConsoleOutput extends AbstractOutput
{
    /** @var resource */
    private $stream;

    public function __construct()
    {
        $this->stream = $this->openOutputStream();
    }

    protected function doWrite(string $message, bool $newline = false) : void
    {
        if ($newline) {
            $message .= \PHP_EOL;
        }

        @fwrite($this->stream, $message);

        fflush($this->stream);
    }

    public function writeError(string $message, bool $newline = true) : void
    {
        $this->doWrite("\033[31m$message \033[0m", $newline);
    }

    public function writeInfo(string $message, bool $newline = true) : void
    {
        $this->doWrite("\033[36m$message \033[0m", $newline);
    }

    public function writeWarning(string $message, bool $newline = true) : void
    {
        $this->doWrite("\033[33m$message \033[0m", $newline);
    }

    public function writeSuccess(string $message, bool $newline = true) : void
    {
        $this->doWrite("\033[32m$message \033[0m", $newline);
    }

    /** @return resource */
    private function openOutputStream()
    {
        if (!$this->hasStdoutSupport()) {
            return fopen('php://output', 'w');
        }

        return @fopen('php://stdout', 'w') ?: fopen('php://output', 'w');
    }

    /**
     * Returns true if current environment supports writing console output to
     * STDOUT.
     *
     * @return bool
     */
    protected function hasStdoutSupport(): bool
    {
        return false === $this->isRunningOS400();
    }

    /**
     * Checks if current executing environment is IBM iSeries (OS400), which
     * doesn't properly convert character-encodings between ASCII to EBCDIC.
     *
     * @return bool
     */
    private function isRunningOS400(): bool
    {
        $checks = [
            \function_exists('php_uname') ? php_uname('s') : '',
            getenv('OSTYPE'),
            \PHP_OS,
        ];

        return false !== stripos(implode(';', $checks), 'OS400');
    }

}
