<?php

namespace Bot\Command\Worker;

use Bot\Mode\Quest\QuestStepsSenderTrait;
use Bot\Config\QuestConfig;
use Bot\DTO\WebhookUpdate;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Service\HttpClientService;
use Bot\Service\QuestProgressService;

final class RestartWorker implements WorkerInterface
{
    use QuestStepsSenderTrait;

    protected Quest $quest;

    public function __construct(
        QuestConfig $questConfig,
        protected HttpClientService $httpClientService,
        protected QuestProgressService $questProgressService
    ) {
        $this->quest = new Quest($questConfig);
    }

    /**
     * @param WebhookUpdate $webhookUpdate
     * @return void
     */
    public function run(WebhookUpdate $webhookUpdate): void
    {
        $userId = $webhookUpdate->message->from->id;
        $step = $this->quest->getStepById($this->quest->getStartId());

        $this->sendCommandsByStep(
            $step,
            $userId,
            $this->quest->getButtonFormatStrategy(),
            $this->httpClientService
        );

        $this->questProgressService->loadProgressStash($this->quest->getHash())
            ->updateProgress($userId, $step);
    }
}