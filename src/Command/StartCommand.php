<?php

namespace Bot\Command;

use Bot\DTO\WebhookUpdate;

final class StartCommand extends Command
{
    public function handleWebhook(WebhookUpdate $webhookUpdate): void
    {
        $this->worker->run($webhookUpdate);
    }
}