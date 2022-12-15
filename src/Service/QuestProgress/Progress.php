<?php

namespace Bot\Service\QuestProgress;

use Bot\Mode\Quest\Entity\Step;
use Bot\Service\Stash\Stash;

final class Progress
{
    public function __construct(
        protected Stash $stash
    ) {
    }

    public function userHasProgress(string|int $userId): bool
    {
        return $this->stash->has($userId);
    }

    public function getUserCurrentStep(string|int $userId): ?string
    {
        return $this->stash->get($userId);
    }

    public function updateProgress(string|int $userId, Step $step): void
    {
        $this->stash->set($userId, $step->getId());
        $this->stash->save();
    }
}