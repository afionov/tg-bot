<?php

namespace Bot\Command\Worker;

use Bot\DTO\WebhookUpdate;

interface WorkerInterface
{
    public function run(WebhookUpdate $webhookUpdate): void;
}