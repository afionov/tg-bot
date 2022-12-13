<?php

namespace Bot\Mode\Quest;

use Bot\Service\Stash\Stash;
use Bot\Service\StashService;

final class Progress
{
    protected const STASH_INDEX = 'progress';

    protected bool $hasProgress = false;

    protected ?string $currentStep;

    protected ?Stash $stash;

    public function __construct(
        protected string $username,
        protected readonly StashService $stashService,
        string $questHash
    ) {
        $this->stash = $this->stashService
            ->load(name: $questHash, index: self::STASH_INDEX)
            ->get(self::STASH_INDEX);
        $userProgress = $this->stash->get($this->username);

        if (is_null($userProgress)) {
            return;
        }
        
        $this->hasProgress = true;
        $this->currentStep = $userProgress;
    }

    public function hasProgress(): bool
    {
        return $this->hasProgress;
    }

    public function getCurrentStep(): ?string
    {
        return $this->currentStep;
    }

    public function updateProgress(Step $step): void
    {
        $this->stash->set($this->username, $step->getId());
        $this->stash->save();
    }
}