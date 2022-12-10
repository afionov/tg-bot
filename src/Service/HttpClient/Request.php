<?php

namespace Bot\Service\HttpClient;

class Request extends \GuzzleHttp\Psr7\Request
{
    public function __construct(string $uri, array $bodyFields)
    {
        parent::__construct('POST', $uri, [], []);
    }
}