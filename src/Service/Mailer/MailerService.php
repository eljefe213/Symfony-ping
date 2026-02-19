<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;
use Psr\Log\LoggerInterface;

class MailerService
{

    private const WELCOME_SUBJECT = 'Welcome';
    private const WELCOME_MESSAGE = 'Hello and Welcome !';

    public function __construct(
        private LoggerInterface $logger,
        private MailerTransportInterface $mailerTransport,
        private string $adminEmail,
    ) {}

    public function welcome(string $email): void
    {

        $this->logger->info('MailerService.welcome start',[
            'to' => $email,
            'transport' => get_class($this->mailerTransport),
        ]);

        $this->mailerTransport->send($email, self::WELCOME_SUBJECT, self::WELCOME_MESSAGE);

        $this->logger->info('MailerService.welcome success ',[
            'subject' => self::WELCOME_SUBJECT,
        ]);
    }

}
