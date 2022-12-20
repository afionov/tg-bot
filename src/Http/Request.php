<?php

namespace Bot\Http;

use GuzzleHttp\Psr7\Request as BaseRequest;

final class Request extends BaseRequest
{
    protected const METHOD = 'POST';

    /**
     * @param string $uri
     * @param array<string, string|string[]> $additionalHeaders
     * @param array $body
     */
    public function __construct(string $uri, array $additionalHeaders = [], array $body = [])
    {
        parent::__construct(
            self::METHOD,
            $uri,
            array_merge_recursive(
                [
                    'Content-Type' => 'application/json'
                ],
                $additionalHeaders
            ),
            json_encode($body)
        );
    }
}