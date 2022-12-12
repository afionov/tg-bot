<?php

namespace Bot\Service\Stash;

interface StashInterface
{
    public function save(): void;

    public function getData(): array;

    public function get($key): mixed;
}