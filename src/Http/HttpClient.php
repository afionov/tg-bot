<?php

namespace Bot\Http;

use Bot\DTO\DTO;
use Bot\Helper\DTO\Hydrator\Exception\AttributeValidationException;
use Bot\Helper\DTO\Hydrator\Exception\InternalClassException;
use Bot\Helper\DTO\Hydrator\Exception\InvalidDTOException;
use Bot\Helper\DTO\Hydrator\Exception\UndefinedDTOException;
use Bot\Helper\DTO\Hydrator\Hydrator;
use Bot\Http\Command\Command;
use Bot\Http\Command\CompositeCommand;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

final class HttpClient
{
    protected const TELEGRAM_URL = 'https://api.telegram.org/bot';

    /**
     * @param string $botToken
     * @param ClientInterface $client
     * @param array<string, string> $additionalHeaders
     */
    public function __construct(
        protected string $botToken,
        protected ClientInterface $client,
        protected array $additionalHeaders = []
    ) {
    }

    /**
     * @param Command $command
     * @return DTO
     * @throws AttributeValidationException
     * @throws ClientExceptionInterface
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws UndefinedDTOException
     */
    public function sendCommand(Command $command): DTO
    {
        $response = $this->client->sendRequest(
            new Request(
                self::TELEGRAM_URL . $this->botToken . '/' . $command->getMethod(),
                $this->additionalHeaders,
                $command->getBody()
            )
        );

        return $this->handleResponse($response, $command->getResponseDTOClassName());
    }

    /**
     * @param ResponseInterface $response
     * @param class-string<DTO> $responseDTOClassName
     * @return DTO
     * @throws AttributeValidationException
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws UndefinedDTOException
     */
    protected function handleResponse(ResponseInterface $response, string $responseDTOClassName): DTO
    {
        if ($response->getStatusCode() !== 200) {

        }

        $responseData = json_decode($response->getBody()->getContents(), true);

        if (!is_array($responseData)) {
            throw new InvalidArgumentException('Invalid response data');
        }

        return Hydrator::hydrate($responseDTOClassName, $responseData);
    }

    /**
     * @param CompositeCommand $compositeCommand
     * @param CompositeResponse $compositeResponse
     * @return CompositeResponse
     * @throws AttributeValidationException
     * @throws ClientExceptionInterface
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws UndefinedDTOException
     */
    public function sendCompositeCommand(
        CompositeCommand $compositeCommand,
        CompositeResponse $compositeResponse
    ): CompositeResponse {
        $command = $compositeCommand->shift();

        if ($command !== null) {
            $compositeResponse->addResponse($this->sendCommand($command));
            return $this->sendCompositeCommand($compositeCommand, $compositeResponse);
        }

        return $compositeResponse;
    }
}