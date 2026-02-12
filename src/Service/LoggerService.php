<?php

namespace App\Service;

class LoggerService
{
    public function log(string $message): void
    {
        $path = \dirname(__DIR__, 2) . '/var/custom.log';
        file_put_contents($path, $message . PHP_EOL, FILE_APPEND);
    }
}
