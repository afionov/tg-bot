<?php

namespace Bot;

use Bot\Entity\Helper\Hydrator;
use Bot\Entity\WebhookUpdate;
use Bot\Log\Logger;
use Bot\Mode\ModeInterface;
use Throwable;

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
        try {
            $webhookMessage = Hydrator::hydrateFromRequest(new WebhookUpdate);
            $this->mode->handleWebhook($webhookMessage);
        } catch(Throwable $e) {
            Logger::log($e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }
    }
}