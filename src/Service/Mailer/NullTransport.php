<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;

class NullTransport implements MailerTransportInterface
{
    public array $sent = [];

    public function send(string $email, string $subject, string $message): void
    {
        $this->sent[] = compact('email', 'subject', 'message');
    }
}
