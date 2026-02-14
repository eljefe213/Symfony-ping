<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;

class MailerService
{
    public function __construct(private MailerTransportInterface $transport)
    {}

    public function welcome(string $email): void
    {
        $this->transport->send($email, 'Welcome', 'Hello and Welcome !');
    }
}
