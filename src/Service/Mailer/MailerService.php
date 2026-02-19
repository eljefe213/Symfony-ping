<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;
use Psr\Log\LoggerInterface;

class MailerService
{
    public function __construct(
        private LoggerInterface $logger,
        private MailerTransportInterface $mailerTransport,
        private string $adminEmail,
    ) {}

    public function welcome(string $email): void
    {
        $subject = 'Welcome';
        $message = 'Bienvenue !';

        $this->logger->info('MailerService.welcome start',[
            'to' => $email,
            'transport' => get_class($this->mailerTransport),
        ]);

        $this->mailerTransport->send($email, $subject, $message);

        $this->logger->info('MailerService.welcome success ',[
            'subject' => $subject,
        ]);
    }

}
