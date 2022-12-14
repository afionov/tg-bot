<?php

namespace Bot\Service;

use Bot\Bot;
use Bot\Service\HttpClient\Command\Command;
use Bot\Service\HttpClient\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class HttpClientService
{
    protected const TELEGRAM_URL = 'https://api.telegram.org/bot';

    public function __construct(
        protected ClientInterface $client,
        protected LoggerService $loggerService
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendCommand(Command $command): void
    {
        $response = $this->client->sendRequest(
            new Request(
                self::TELEGRAM_URL . Bot::$token . '/' . $command->getMethod(),
                $command->getBody()
            )
        );

        if ($response->getStatusCode() !== 200) {
            $this->loggerService->error($response->getReasonPhrase(), [
                'sent' => $command->toArray(),
                'response_body' => $response->getBody()->getContents()
            ]);
        }
    }
}