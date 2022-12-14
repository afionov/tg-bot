<?php

namespace Bot\Interfaces;

use Bot\DTO\WebhookUpdate;

interface WebhookHandlerInterface
{
    public function handleWebhook(WebhookUpdate $webhookUpdate);
}