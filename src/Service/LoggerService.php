<?php

namespace App\Service;

class LoggerService
{
    public function __construct(private string $projectDir)
    {
    }
    public function log(string $message): void
    {
        $path = $this->projectDir . '/var/custom.log';
        file_put_contents($path, $message . PHP_EOL, FILE_APPEND);
    }
}
