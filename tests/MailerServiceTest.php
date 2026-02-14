<?php

namespace App\Tests;

use App\Interface\MailerTransportInterface;
use App\Service\Mailer\MailerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function PHPUnit\Framework\assertInstanceOf;

class MailerServiceTest extends KernelTestCase
{
    public function testMailerServiceUsesConfiguredTransport(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $mailer = $container->get(MailerService::class);
        $transport = $container->get(MailerTransportInterface::class);

        $this>assertInstanceOf(MailerService::class, $mailer);
        $this->assertInstanceOf(MailerTransportInterface::class, $transport);
    }

    public function testWelcomeSendsMessageThroughNullTransport(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $mailer = $container->get(MailerService::class);
        $transport = $container->get(MailerTransportInterface::class);

        $mailer->welcome('test@example.com');

        $this->assertTrue(property_exists($transport, 'sent'));
        $this->assertCount(1, $transport->sent);
        $this->assertSame('test@example.com', $transport->sent[0]['email']);
        $this->assertSame('Welcome', $transport->sent[0]['subject']);
        $this->assertSame('Hello and Welcome !', $transport->sent[0]['message']);
    }
}
