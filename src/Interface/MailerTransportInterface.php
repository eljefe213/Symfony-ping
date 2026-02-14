<?php

namespace App\Interface;

interface MailerTransportInterface
{
    public function send(string $email, string $subject, string $message): bool;
}
