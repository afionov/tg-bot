<?php

namespace Bot\Config;

use Bot\ArrayableInterface;

final class Config implements ArrayableInterface
{
    protected array $data = [];

    public function __construct(protected string $path)
    {
        $this->data = json_decode(file_get_contents($this->path), true);
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}