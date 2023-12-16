<?php

namespace Bot;

use Bot\Http\Command\CompositeCommand;
use Bot\Http\CompositeResponse;
use Bot\Http\HttpClient;
use Bot\Http\Webhook;
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

    /**
     * @return CompositeResponse
     * @throws \Throwable
     */
    public function handleWebhook(): CompositeResponse
    {
        $webhookDTO = Webhook::createFromGlobalPayload();

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
            botToken: $this->configuration->getToken(),
            client: $this->configuration->getHttpClient(),
            additionalHeaders: $this->configuration->getAdditionalHeaders()
        );

        $compositeResponse = new CompositeResponse();

        return $httpClient->sendCompositeCommand($compositeCommand, $compositeResponse);
    }
}