<?php

namespace Bot\Interfaces;

use Bot\DTO\Update;
use Bot\Http\Command\CompositeCommand;

interface WebhookHandlerInterface
{
    public function handleWebhook(Update $webhookUpdate): CompositeCommand;
}