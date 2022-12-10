<?php

namespace Bot\Entity;

use Bot\General\WebhookInterface;

class WebhookUpdate extends Entity implements WebhookInterface
{
    public int $update_id;

    public Message $message;

    public static function createFromRequest(): WebhookUpdate
    {
        $webhookRequest = file_get_contents('php://input');
        return self::createFromArray(json_decode($webhookRequest, true));
    }
}