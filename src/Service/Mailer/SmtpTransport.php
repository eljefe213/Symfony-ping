<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;
use PharIo\Manifest\Email;
use Symfony\Component\Mailer\MailerInterface;

class SmtpTransport implements MailerTransportInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private string $host,
    ) {}

    public function send(string $email, string $subject, string $message): void
    {
        $emailObject = (new Email())
            ->from($this->host)
            ->to($email)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($emailObject);
    }
}
