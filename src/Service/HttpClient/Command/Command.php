<?php

namespace Bot\Service\HttpClient\Command;

use Bot\ArrayableInterface;

abstract class Command implements ArrayableInterface
{
    protected string|int $chat_id;

    public function toArray(): array
    {
        return (array) $this;
    }

    abstract public function getBody(): array;

    abstract public function getMethod(): string;
}