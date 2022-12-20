<?php

namespace Bot;

use Bot\Command\CommandInterface;
use Bot\Command\DefaultStartCommand;
use Bot\DTO\Update;
use Bot\Helper\DTO\Hydrator\Hydrator;
use Bot\Http\Command\CompositeCommand;
use Bot\Http\CompositeResponse;
use Bot\Http\Exception\BadRequestEnum;
use Bot\Http\Exception\BadRequestException;
use Bot\Http\HttpClient;
use Bot\Interfaces\WebhookHandlerInterface;
use Bot\Mode\ModeInterface;
use Bot\Mode\NullMode;
use Closure;
use Psr\Http\Client\ClientInterface;

final class Bot
{
    /**
     * @param string $token
     * @param ClientInterface $httpClient
     * @param null|Closure():ModeInterface $modeClass
     * @param array<string, Closure():CommandInterface> $commands
     * @param array<string, string> $additionalHeaders
     */
    public function __construct(
        protected readonly string $token,
        protected readonly ClientInterface $httpClient,
        protected ?Closure $modeClass,
        protected readonly array $commands = ['/start' => fn (): CommandInterface => new DefaultStartCommand()],
        protected readonly array $additionalHeaders = []
    ) {
        if (!isset($modeClass)) {
            $this->modeClass = fn (): ModeInterface => new NullMode();
        }
    }

    public function handleWebhook(): CompositeResponse
    {
        $webhookDTO = $this->createWebhookDTO();

        $text = $webhookDTO->message->text;

        /**
         * @var WebhookHandlerInterface $handler
         */
        $handler = $this->commands[$text] ?? $this->modeClass;
        $compositeCommand = $handler->handleWebhook($webhookDTO);

        return $this->sendCompositeCommand($compositeCommand);
    }

    public function sendCompositeCommand(CompositeCommand $compositeCommand): CompositeResponse
    {
        $httpClient = new HttpClient($this->token, $this->httpClient, $this->additionalHeaders);
        $compositeResponse = new CompositeResponse();

        return $httpClient->sendCompositeCommand($compositeCommand, $compositeResponse);
    }

    /**
     * @return Update
     * @throws BadRequestException
     * @throws Helper\DTO\Hydrator\Exception\AttributeValidationException
     * @throws Helper\DTO\Hydrator\Exception\InternalClassException
     * @throws Helper\DTO\Hydrator\Exception\InvalidDTOException
     * @throws Helper\DTO\Hydrator\Exception\UndefinedDTOException
     */
    protected function createWebhookDTO(): Update
    {
        $requestData = file_get_contents('php://input');

        if ($requestData === false) {
            throw new BadRequestException(BadRequestEnum::EMPTY_REQUEST_BODY);
        }

        $requestArr = json_decode($requestData, true);

        if (!is_array($requestArr)) {
            throw new BadRequestException(BadRequestEnum::INVALID_REQUEST_BODY);
        }

        /**
         * @var Update $webhookDTO
         */
        $webhookDTO = Hydrator::hydrate(Update::class, $requestArr);

        return $webhookDTO;
    }
}