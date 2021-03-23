<?php
declare(strict_types=1);

namespace Twitchfa\Tests\Message;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Twitchfa\Exceptions\TransformResponseException;
use Twitchfa\Message\ResponseTransformer;

class ResponseTransformerTest extends TestCase {

    public function testTransform(): void {
        $data = ['data' => ['streamer' => 'test']];
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($data));

        self::assertEquals($data, ResponseTransformer::transform($response));
    }

    public function testTransformWithEmptyBody(): void {
        $data = [];
        $response = new Response(200, ['Content-Type' => 'application/json'], json_encode($data));

        self::assertEquals($data, ResponseTransformer::transform($response));
    }

    public function testTransformThrowTransformResponseException(): void {
        $response = new Response(200, ['Content-Type' => 'application/json'], '');
        $this->expectException(TransformResponseException::class);
        ResponseTransformer::transform($response);
    }

    public function testTransformWithIncorrectContentType(): void {
        $data = [];
        $response = new Response(200, ['Content-Type' => 'application/javascript'], json_encode($data));
        $this->expectException(TransformResponseException::class);

        self::assertEquals($data, ResponseTransformer::transform($response));
    }
}
