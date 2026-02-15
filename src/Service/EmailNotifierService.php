<?php

namespace App\Service;

use App\Interface\MailerTransportInterface;

class EmailNotifierService
{
    public function __construct(
        private MailerTransportInterface $transport,
        private string $adminEmail,
    )
    {}
}
