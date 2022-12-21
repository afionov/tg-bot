<?php

namespace Bot;

use Bot\DTO\Update;
use Bot\Helper\DTO\Hydrator\Hydrator;
use Bot\Http\Command\CompositeCommand;
use Bot\Http\CompositeResponse;
use Bot\Http\Exception\BadRequestEnum;
use Bot\Http\Exception\BadRequestException;
use Bot\Http\HttpClient;
use Bot\Interfaces\WebhookHandlerInterface;

final class Bot
{
    /**
     * @param Configuration $configuration
     */
    public function __construct(
        protected Configuration $configuration
    ) {
    }

    public function handleWebhook(): CompositeResponse
    {
        $webhookDTO = $this->createWebhookDTO();

        $text = $webhookDTO->message->text;

        /**
         * @var WebhookHandlerInterface $handler
         */
        $handler = $this->configuration->hasCommand($text)
            ? $this->configuration->getCommand($text)
            : $this->configuration->getMode();
        $compositeCommand = $handler->handleWebhook($webhookDTO);

        return $this->sendCompositeCommand($compositeCommand);
    }

    public function sendCompositeCommand(CompositeCommand $compositeCommand): CompositeResponse
    {
        $httpClient = new HttpClient(
            $this->configuration->getToken(),
            $this->configuration->getHttpClient(),
            $this->configuration->getAdditionalHeaders()
        );
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