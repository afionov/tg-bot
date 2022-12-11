<?php

namespace Bot\Entity;

use Bot\Entity\Telegram\Message;

class WebhookUpdate extends Entity
{
    public int $update_id;

    public Message $message;
}