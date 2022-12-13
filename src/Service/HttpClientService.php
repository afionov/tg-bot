<?php

namespace Bot\Service;

use Bot\Log\Logger;
use Bot\Service\HttpClient\Command\Command;
use Bot\Service\HttpClient\Command\SendKeyboard;
use Bot\Service\HttpClient\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class HttpClientService
{
    protected const TELEGRAM_URL = 'https://api.telegram.org/bot';

    public function __construct(
        protected string $token,
        protected ClientInterface $client
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendCommand(Command $command): void
    {
        $response = $this->client->sendRequest(
            new Request(
                self::TELEGRAM_URL . $this->token . '/' . $command->getMethod(),
                $command->getBody()
            )
        );

        if ($response->getStatusCode() !== 200) {
            Logger::log($response->getReasonPhrase(), ['sent_entity' => $command->toArray()]);
        }
    }
}