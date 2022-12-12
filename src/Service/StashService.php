<?php

namespace Bot\Service;

use Bot\Service\Stash\Stash;
use Bot\Service\Stash\Type\ContentType;
use Bot\Service\Stash\Type\StashTypeFactory;

final class StashService
{
    protected const STASH_PATH = __DIR__ . '/../../';

    protected array $stashes = [];

    public function load(
        string $name,
        ContentType $contentType = ContentType::JSON,
        ?string $index = null
    ): StashService {
        $stashType = StashTypeFactory::make($contentType);
        $stash = $stashType->createStash(self::STASH_PATH . $name . '.' . $stashType->getExtension());

        if (isset($index)) {
            $this->stashes[$index] = $stash;
            return $this;
        }

        $this->stashes[] = $stash;

        return $this;
    }

    public function save(string|int $index): void
    {
        $this->get($index)?->save();
    }

    public function get(string|int $index): ?Stash
    {
        return $this->stashes[$index] ?? null;
    }
}