<?php

namespace Bot\Mode;

use Bot\Entity\WebhookUpdate;

interface ModeInterface
{
    public function handleWebhook(WebhookUpdate $webhook): void;
}