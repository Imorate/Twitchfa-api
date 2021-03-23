<?php
declare(strict_types=1);

namespace Twitchfa\Tests\Api;


use Twitchfa\Api\Twitch;
use Twitchfa\TwitchfaClient;

class TwitchTest extends Api {

    protected $api;

    public function setUp(): void {
        $this->api = new Twitch(new TwitchfaClient($this->getMockClient()));
    }

    public function testGetTwitchStats(): void {
        $this->api->getTwitchStats();
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/stats',
            $request->getUri()->__toString()
        );
    }

    public function testGetBanners(): void {
        $this->api->getBanners();
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/banners',
            $request->getUri()->__toString()
        );
    }

    public function testGetNotifications(): void {
        $this->api->getNotifications();
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/notifications',
            $request->getUri()->__toString()
        );
    }

    public function testSearchStreamers(): void {
        $this->api->searchStreamers('test');
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/streamers/search?q=test',
            $request->getUri()->__toString()
        );
    }

    public function testGetSelf(): void {
        $this->api->getSelf('access_token');
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/self',
            $request->getUri()->__toString()
        );
    }

    public function testGetFollowings(): void {
        $this->api->getFollowing('access_token');
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/following',
            $request->getUri()->__toString()
        );
    }

    public function testGetStreamers(): void {
        $this->api->getStreamers(1, 10);
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/streamers?page=1&limit=10',
            $request->getUri()->__toString()
        );
    }

    public function testAddStreamer(): void {
        $this->api->addStreamer('test');
        $request = $this->getLastRequest();
        self::assertEquals(
            'v2/twitch/streamers',
            $request->getUri()->__toString()
        );
    }
}