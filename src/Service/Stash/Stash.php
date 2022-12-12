<?php

namespace Bot\Service\Stash;

use Bot\Service\Stash\Type\StashTypeInterface;

final class Stash implements StashInterface
{
    public function __construct(
        protected array $data,
        protected string $path,
        protected StashTypeInterface $stashType
    ) {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function save(): void
    {
        $this->stashType->save($this);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function get($key): mixed
    {
        return $this->data[$key];
    }
}