<?php

namespace Bot;

use Bot\Entity\WebhookUpdate;
use Bot\Mode\ModeInterface;

final class Bot
{
    /**
     * @param string $token
     * @param ModeInterface $mode
     */
    public function __construct(
        protected string        $token,
        protected ModeInterface $mode
    ) {
    }

    public function handleWebhook(): void
    {
        $requestData = file_get_contents('php://input');
        $webhookMessage = $this->mode
            ->getModeHydrator()
            ->hydrate(WebhookUpdate::class, json_decode($requestData, true));

        $this->mode->handleWebhook($webhookMessage);
    }
}