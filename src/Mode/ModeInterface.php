<?php

namespace Bot\Mode;

use Bot\General\WebhookInterface;

interface ModeInterface
{
    public function handleWebhook(WebhookInterface $webhook);
}