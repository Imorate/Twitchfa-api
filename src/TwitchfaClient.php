<?php
declare(strict_types=1);

namespace Twitchfa;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Twitchfa\Api\Twitch;

/**
 * Class TwitchfaClient
 * @package Twitchfa
 */
class TwitchfaClient {

    /**
     * Base URL
     */
    protected const BASE_URI = 'https://api.twitchfa.com';

    /**
     * Last response
     *
     * @var ResponseInterface
     */
    protected $lastResponse;

    /**
     * HTTP Client
     *
     * @var Client
     */
    private $httpClient;

    /**
     * Twitchfa Client constructor.
     *
     * @param Client|null $client
     * @throws InvalidArgumentException
     */
    public function __construct(?Client $client = null) {
        $this->httpClient = $client ?? new Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * Get Http client
     *
     * @return Client
     */
    public function getHttpClient(): Client {
        return $this->httpClient;
    }


    /**
     * Get last response
     *
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface {
        return $this->lastResponse;
    }

    /**
     * Set last response
     *
     * @param mixed $lastResponse
     */
    public function setLastResponse($lastResponse): void {
        $this->lastResponse = $lastResponse;
    }

    /**
     * Get twitch Api
     *
     * @return Twitch
     */
    public function twitch(): Twitch {
        return new Twitch($this);
    }


}