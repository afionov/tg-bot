<?php

namespace Bot\DTO;

class WebhookUpdate extends DTO
{
    public int $update_id;

    public Message $message;
}