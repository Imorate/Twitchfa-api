<?php

namespace Twitchfa\Api;

use GuzzleHttp\Exception\GuzzleException;
use Twitchfa\Exceptions\StreamerNotFoundException;
use Twitchfa\Exceptions\TransformResponseException;

/**
 * Class Twitch
 *
 * @package Twitchfa\Api
 */
class Twitch extends Api {

    /**
     * Twitchfa Twitch URI
     */
    private const URI = 'twitch';

    /**
     * Get Twitch stats
     *
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getTwitchStats(): array {
        return $this->get('/' . self::URI . '/stats')['data'];
    }

    /**
     * Get banners
     *
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getBanners(): array {
        return $this->get('/' . self::URI . '/banners')['data'];
    }

    /**
     * Get notifications
     *
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getNotifications(): array {
        return $this->get('/' . self::URI . '/notifications')['data'];
    }

    /**
     * Search streamers
     *
     * @param string $name
     * @return array
     * @throws StreamerNotFoundException
     * @throws TransformResponseException
     * @throws GuzzleException
     */
    public function searchStreamers(string $name): array {
        $result = $this->get('/' . self::URI . '/streamers/search', [
            'q' => $name
        ])['data'];
        if (empty($result)) {
            throw new StreamerNotFoundException('Streamer ' . $name . ' not found');
        }
        return $result;
    }

    /**
     * Add streamer
     *
     * @param string $name
     * @return array
     * @throws GuzzleException
     */
    public function addStreamer(string $name): array {
        return $this->post('/' . self::URI . '/streamers', [
            'streamer' => $name
        ]);
    }

    /**
     * Get self
     *
     * @param string $accessToken
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getSelf(string $accessToken): array {
        return $this->authGet('/' . self::URI . '/self', $accessToken)['data'];
    }

    /**
     * Get following
     *
     * @param string $accessToken
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getFollowing(string $accessToken): array {
        return $this->authGet('/' . self::URI . '/following', $accessToken)['data'];
    }

    /**
     * Get streamers
     *
     * @param int $page
     * @param int $limit
     * @return array
     * @throws GuzzleException
     * @throws TransformResponseException
     */
    public function getStreamers(int $page, int $limit): array {
        return $this->get('/' . self::URI . '/streamers', [
            'page' => $page,
            'limit' => $limit
        ])['data'];
    }

}