<?php
declare(strict_types=1);

namespace Twitchfa\Tests\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class Api extends TestCase {
    private $transactions = [];
    private $mockClient = null;

    protected function getLastRequest(): ?RequestInterface {
        if (($count = count($this->transactions)) === 0) {
            return null;
        }
        return $this->transactions[$count - 1]['request'] ?? null;
    }

    protected function getMockClient(): Client {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode(['data' => ['streamer' => 'test']])),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push(Middleware::history($this->transactions));
        $this->mockClient = new Client(['handler' => $handlerStack]);
        return $this->mockClient;
    }

    protected function tearDown(): void {
        $this->mockClient = null;
        $this->transactions = [];
    }
}