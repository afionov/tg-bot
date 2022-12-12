<?php

namespace Bot\Mode\Quest;

use Bot\Service\StashService;

final class Progress
{
    protected const STASH_INDEX = 'progress';

    protected bool $hasProgress = false;

    protected \Bot\Mode\Quest\Entity\Step $currentStep;

    public function __construct(
        protected string $username,
        protected readonly StashService $stashService,
        string $questHash
    ) {
        $progressStash = $this->stashService
            ->load(name: $questHash, index: self::STASH_INDEX)
            ->get(self::STASH_INDEX);
        if (is_null($progressStash)) {
            return;
        }
        $userProgress = $progressStash->get($this->username);
        if (is_null($userProgress)) {
            return;
        }
        $this->hasProgress = true;
        $this->currentStep = Step::fromId($userProgress);
    }

    public function hasProgress(): bool
    {
        return $this->hasProgress;
    }

    public function getCurrentStep()
    {
        return $this->currentStep;
    }

    public function updateProgress(Step $step): void
    {

    }

    public function save()
    {
        $this->entity->users = array_values($this->entity->users);
        $this->stash->loadData($this->entity->toArray());
        $this->stash->save();
    }
}