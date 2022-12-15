<?php

namespace Bot\Command\Worker;

use Bot\Config\QuestConfig;
use Bot\DTO\WebhookUpdate;
use Bot\Mode\Quest\QuestStepsSenderTrait;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Service\HttpClientService;
use Bot\Service\QuestProgressService;

final class InvokeStepWorker implements WorkerInterface
{
    use QuestStepsSenderTrait;

    protected Quest $quest;

    public function __construct(
        QuestConfig $questConfig,
        protected HttpClientService $httpClientService,
        protected QuestProgressService $progressService
    ) {
        $this->quest = new Quest($questConfig);
    }

    public function run(WebhookUpdate $webhookUpdate): void
    {
        $progress = $this->progressService->loadProgressStash($this->quest->getHash());
        $userId = $webhookUpdate->message->from->id;

        if (!$progress->userHasProgress($userId)) {
            return;
        }

        $step = $this->quest->getStepById($progress->getUserCurrentStep($userId));

        $this->sendCommandsByStep(
            $step,
            $userId,
            $this->quest->getButtonFormatStrategy(),
            $this->httpClientService
        );
    }
}