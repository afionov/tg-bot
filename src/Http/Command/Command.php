<?php

namespace Bot\Http\Command;

use Bot\DTO\DTO;
use Bot\Interfaces\ArrayableInterface;

abstract class Command implements ArrayableInterface
{
    public function toArray(): array
    {
        return (array) $this;
    }

    abstract public function getBody(): array;

    /**
     * @return non-empty-string
     */
    abstract public function getMethod(): string;

    /**
     * @return class-string<DTO>
     */
    abstract public function getResponseDTOClassName(): string;
}