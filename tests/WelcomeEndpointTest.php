<?php

namespace App\Tests;

use App\Interface\MailerTransportInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WelcomeEndpointTest extends WebTestCase
{
    public function testWelcomeEndpointUsesNullTransportInTestEnv(): void
    {
        $client = static::createClient(['environment' => 'test']);

        $client->request('POST', '/api/welcome', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['email' => 'test@example.com']));

        self::assertResponseIsSuccessful();

        $transport = static::getContainer()->get(MailerTransportInterface::class);
        self::assertCount(1, $transport->sent);
        self::assertSame('test@example.com', $transport->sent[0]->getEmail());
    }

}
