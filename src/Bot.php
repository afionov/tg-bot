<?php

namespace Bot;

use Bot\Command\CommandFactory;
use Bot\Config\Config;
use Bot\DI\ServiceLocator;
use Bot\DTO\WebhookUpdate;
use Bot\Interfaces\WebhookHandlerInterface;
use Bot\Mode\ModeFactory;
use Bot\Service\HydratorService;

final class Bot
{
    public static string $token = '';

    protected string $modeClass;

    protected array $commands;

    public function __construct(Config $config)
    {
        self::$token = $config->get('token');
        $this->modeClass = $config->get('mode');
        $this->commands = $config->get('commands');
        ServiceLocator::init();
    }

    public function handleWebhook(): void
    {
        $requestData = file_get_contents('php://input');

        /**
         * @var WebhookUpdate $webhookMessage
         */
        $webhookMessage = ServiceLocator::get(HydratorService::class)
            ->hydrate(WebhookUpdate::class, json_decode($requestData, true));
        $text = $webhookMessage->message->text;

        /**
         * @var WebhookHandlerInterface $handler
         */
        $handler = isset($this->commands[$text])
            ? CommandFactory::make($this->commands[$text])
            : ModeFactory::make($this->modeClass);

        $handler->handleWebhook($webhookMessage);
    }
}