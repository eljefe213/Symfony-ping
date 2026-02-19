<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;
use Psr\Log\LoggerInterface;

class FileTransport implements MailerTransportInterface
{
    private string $dir;

    public function __construct(
        private string $projectDir,
        private LoggerInterface $logger,
    ) {
        $this->dir = rtrim($this->projectDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'email';
    }

    public function send(string $email, string $subject, string $message): void
    {
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0775, true);
        }

        $filename = $this->dir . DIRECTORY_SEPARATOR . date('Ymd_His') . '_' . bin2hex(random_bytes(4) . '.txt');

        $payload = sprintf(
            'TO : %s \nSUBJECT: %s\n\n%s\n',
            $email,
            $subject,
            $message
        );

        file_put_contents($filename, $payload);
        $this->logger->info('FileTransport wrote email',['file' => $filename]);
    }
}
