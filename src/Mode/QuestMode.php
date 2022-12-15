<?php

namespace Bot\Mode;

use Bot\Command\Worker\WorkerInterface;
use Bot\DTO\WebhookUpdate;

final class QuestMode implements ModeInterface
{
    public function __construct(
        protected WorkerInterface $worker
    ) {
    }

    public function handleWebhook(WebhookUpdate $webhookUpdate): void
    {
        $this->worker->run($webhookUpdate);
    }
}