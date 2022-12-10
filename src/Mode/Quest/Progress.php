<?php

namespace Bot\Mode\Quest;

use Bot\Service\StashService;

class Progress
{
    protected Entity\Progress $entity;

    protected bool $hasProgress = false;

    protected \Bot\Mode\Quest\Entity\Step $currentStep;

    public function __construct(
        protected string $username,
        protected readonly StashService $stashService
    )
    {
        $this->stash->load($this->stash->generateDefaultFilepathByName($questHash));
        $this->entity = Entity\Progress\Progress::createFromArray($this->stash->toArray());
        $this->entity->mapArrayValue('users', 'username');
        if(isset($this->entity->users[$this->username])) {
            $this->hasProgress = true;
        }
    }

    public function hasProgress(): bool
    {
        return $this->hasProgress;
    }

    public function getCurrentStep(): \Bot\Service\Quest\Entity\Step
    {
        return $this->currentStep;
    }

    public function updateCurrentStep()
    {

    }

    public function save()
    {
        $this->entity->users = array_values($this->entity->users);
        $this->stash->loadData($this->entity->toArray());
        $this->stash->save();
    }
}