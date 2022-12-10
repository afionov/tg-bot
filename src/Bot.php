<?php

namespace Bot;

use Bot\Entity\WebhookUpdate;
use Bot\Log\Logger;
use Bot\Mode\ModeInterface;
use Throwable;

class Bot
{
    /**
     * @param string $token
     * @param ModeInterface $modeService
     */
    public function __construct(
        protected string               $token,
        protected ModeInterface $modeService
    )
    {
    }

    public function handleWebhook(): void
    {
        try {
            $webhookMessage = WebhookUpdate::createFromRequest();
            $this->modeService->handleWebhook($webhookMessage);
        } catch(Throwable $e) {
            Logger::log($e->getMessage() . PHP_EOL . $e->getTraceAsString());
            return;
        }
    }
}