<?php
declare(strict_types=1);

namespace Twitchfa\Api;


use GuzzleHttp\Exception\GuzzleException;
use Twitchfa\Exceptions\TransformResponseException;
use Twitchfa\Message\ResponseTransformer;
use Twitchfa\TwitchfaClient;

/**
 * Class Api
 *
 * @package Twitchfa\Api
 */
abstract class Api {

    /**
     * Twitchfa Client
     *
     * @var TwitchfaClient
     */
    protected $client;

    /**
     * Api version
     *
     * @var string
     */
    private $version = 'v2';

    /**
     * Api constructor.
     *
     * @param TwitchfaClient $client
     */
    public function __construct(TwitchfaClient $client) {
        $this->client = $client;
    }

    /**
     * GET Method
     *
     * @param string $uri
     * @param array $query
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function get(string $uri, array $query = []): array {
        $response = $this->client->getHttpClient()->request('GET', $this->version . $uri, [
            'query' => $query
        ]);
        $this->client->setLastResponse($response);
        return ResponseTransformer::transform($response);
    }

    /**
     * Authenticated GET Method
     *
     * @param string $uri
     * @param string $accessToken
     * @param array $query
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function authGet(string $uri, string $accessToken, array $query = []): array {
        $response = $this->client->getHttpClient()->request('GET', $this->version . $uri, [
            'query' => $query,
            'headers' => [
                'Authorization' => "Bearer " . $accessToken
            ],
        ]);
        $this->client->setLastResponse($response);
        return ResponseTransformer::transform($response);
    }

    /**
     * POST Method
     *
     * @param string $uri
     * @param array $body
     * @return array
     * @throws GuzzleException
     */
    public function post(string $uri, array $body = []): array {
        $result = [];
        $response = $this->client->getHttpClient()->request('POST', $this->version . $uri, [
            'json' => $body
        ]);
        $result['status_code'] = $response->getStatusCode();
        $result['message'] = $response->getBody()->getContents();
        return $result;
    }

}