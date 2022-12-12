<?php

namespace Bot\Service\Stash\Type;

use Bot\Service\Stash\Stash;

interface StashTypeInterface
{
    public function getExtension(): string;

    public function createStash(string $path): Stash;

    public function save(Stash $stash): void;
}