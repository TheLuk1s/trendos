<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class NotificationControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = NotificationControllerTest::createClient();
        $this->client->setServerParameter('HTTP_ACCEPT', 'application/json');
    }

    public function testEligibleUserReturnsNotification(): void
    {
        $this->client->request('GET', '/notifications?user_id=2');

        self::assertResponseStatusCodeSame(200);

        $response = json_decode(
            (string) $this->client->getResponse()->getContent(),
            true
        );

        self::assertCount(1, $response);
        self::assertSame('Configurar dispositivo Android', $response[0]['title']);
        self::assertSame('https://trendos.com/', $response[0]['cta']);
    }

    #[DataProvider('invalidUserProvider')]
    public function testInvalidAndUnknownUsers(string $url, int $status): void
    {
        $this->client->request('GET', $url);

        self::assertResponseStatusCodeSame($status);
    }

    public static function invalidUserProvider(): array
    {
        return [
            'missing user_id' => ['/notifications', 404],
            'unknown user' => ['/notifications?user_id=9999999', 404],
        ];
    }
}
