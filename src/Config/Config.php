<?php

namespace Bot\Config;

use ArrayIterator;
use Bot\Interfaces\ArrayableInterface;
use IteratorAggregate;
use JsonException;
use Traversable;

abstract class Config implements ArrayableInterface, IteratorAggregate
{
    protected array $data = [];

    /**
     * @throws JsonException
     */
    final public function __construct()
    {
        $this->data = json_decode(
            json: file_get_contents($this->getPath()),
            associative: true,
            flags: JSON_THROW_ON_ERROR
        );
    }

    final public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    final public function get(string $name)
    {
        return $this->__get($this->data[$name]);
    }

    final public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    final public function toArray(): array
    {
        return $this->data;
    }

    final public function getHash(): string
    {
        return md5_file($this->getPath());
    }

    final public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    abstract protected function getPath(): string;
}