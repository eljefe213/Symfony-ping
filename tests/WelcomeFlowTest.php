<?php

namespace App\Tests;

use App\Interface\MailerTransportInterface;
use App\Service\Mailer\NullTransport;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class WelcomeFlowTest extends kernelTestCase
{
    public function testWelcomeUsesNullTransport(): void
    {
        self::bootKernel(['environment' => 'test']);
        $container = static::getContainer();

        $transport = $container->get(MailerTransportInterface::class);
        self::assertInstanceOf(NullTransport::class, $transport);

        $transport->send('test@example.com', 'Welcome', 'Bienvenue !');
        self::assertCount(1, $transport->sent);
        self::assertSame('test@example.com', $transport->sent[0]['email']);
    }
}
