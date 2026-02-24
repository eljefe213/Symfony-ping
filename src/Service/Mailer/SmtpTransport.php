<?php

namespace App\Service\Mailer;

use App\Interface\MailerTransportInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SmtpTransport implements MailerTransportInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private string $fromEmail,
    ) {}

    public function send(string $email, string $subject, string $message): void
    {
        $emailObject = (new Email())
            ->from($this->fromEmail)
            ->to($email)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($emailObject);
    }
}
