<?php

namespace Bot\Service\Stash;

interface StashInterface
{
    public function save(): void;

    public function getData(): array;

    public function get(string|int $key): mixed;

    public function set(string|int $key, mixed $value): void;
}