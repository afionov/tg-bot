<?php

namespace Bot\Service\HttpClient;

final class Request extends \GuzzleHttp\Psr7\Request
{
    protected const METHOD = 'POST';

    public function __construct(string $uri, array $bodyFields)
    {
        parent::__construct(
            self::METHOD,
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($bodyFields)
        );
    }
}