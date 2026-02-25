<?php

namespace App\Tests;

use App\Interface\MailerTransportInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class WelcomeEndpointTest extends kernelTestCase
{
    public function testSend(): void
    {
        self::bootKernel(['environment' => 'test']);
        $container = static::getContainer();

        $transport = $container->get(MailerTransportInterface::class);
        self::assertInstanceOf(MailerTransportInterface::class, $transport);

        $transport->send('test@example.com', 'Welcome', 'Bienvenue à vous !');
        self::assertCount(1, $transport->sent);
        self::assertSame('test@example.com', $transport->sent[0]['email']);
    }

}
