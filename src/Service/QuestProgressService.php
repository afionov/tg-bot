<?php

namespace Bot\Service;

use Bot\Service\QuestProgress\Progress;

class QuestProgressService
{
    protected const STASH_INDEX = 'progress';

    public function __construct(
        protected StashService $stashService
    ) {
    }

    public function loadProgressStash(string $questHash): Progress
    {
        $stash = $this->stashService
            ->load(name: $questHash, index: self::STASH_INDEX)
            ->get(self::STASH_INDEX);

        return new Progress($stash);
    }
}