<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;

class FileTransport implements MailerTransportInterface
{
    public function __construct(private string $projectDir)
    {}

    public function send(string $email, string $subject, string $message): void
    {
        $path = $this->projectDir . '/var/mails.log';
        $line = sprintf("%s | %s | %s | %s\n", date('Y-m-d H:i:s'), $email, $subject, $message);
        file_put_contents($path, $line, FILE_APPEND);
    }
}
