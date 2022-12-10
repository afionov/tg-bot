<?php

namespace Bot\Service\HttpClient\Command;

use Bot\Entity\Message;

class SendMessage extends Command
{
    protected string $text;

    public function __construct()
    {
    }

    public function getMethod(): string
    {
        return 'sendMessage';
    }

    public function getResponseEntity(): string
    {
        return Message::class;
    }
}