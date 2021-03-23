<?php
declare(strict_types=1);

namespace Twitchfa\Message;

use Psr\Http\Message\ResponseInterface;
use Twitchfa\Exceptions\TransformResponseException;

/**
 * Class ResponseTransformer
 *
 * @package Twitchfa\Message
 */
class ResponseTransformer {

    /**
     * Transform response
     *
     * @param ResponseInterface $response
     * @return array
     * @throws TransformResponseException
     */
    public static function transform(ResponseInterface $response): array {
        $body = (string)$response->getBody();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $content = json_decode($body, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content;
            }
            throw new TransformResponseException('Error transforming response to array. JSON_ERROR: '
                . json_last_error() . ' --' . $body . '---');
        }
        throw new TransformResponseException('Error transforming response to array. Content-Type is not application/json');
    }
}