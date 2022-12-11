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
            ['' => ''],
            json_encode($bodyFields)
        );
    }
}