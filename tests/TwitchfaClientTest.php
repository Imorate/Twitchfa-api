<?php
declare(strict_types=1);

namespace Twitchfa\Tests;


use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Twitchfa\Api\Twitch;
use Twitchfa\TwitchfaClient;

class TwitchfaClientTest extends TestCase {

    protected $client;

    public function setUp(): void {
        $this->client = new TwitchfaClient();
    }

    public function testClient(): void {
        self::assertInstanceOf(Client::class, $this->client->getHttpClient());
    }

    public function testTwitch(): void {
        self::assertInstanceOf(Twitch::class, $this->client->twitch());
    }

    public function testGetLastResponseIsNull(): void {
        self::assertNull($this->client->getLastResponse());
    }

    public function testSetLastResponse(): void {
        $response = $this->createMock(ResponseInterface::class);
        $this->client->setLastResponse($response);

        self::assertInstanceOf(ResponseInterface::class, $this->client->getLastResponse());
    }
}