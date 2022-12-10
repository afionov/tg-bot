<?php

namespace Bot\Service\HttpClient\Command;

use Bot\General\ArrayableInterface;
use Bot\General\JsonableInterface;

abstract class Command implements CommandInterface, JsonableInterface, ArrayableInterface
{
    protected string|int $chat_id;

    public function toJson(int $parameters): string
    {
        return json_encode((array)$this, $parameters);
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}