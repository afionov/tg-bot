<?php

namespace Bot\Mode\Quest;

use Bot\Command\Worker\WorkerInterface;
use Bot\Config\QuestConfig;
use Bot\DTO\WebhookUpdate;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Entity\Step;
use Bot\Mode\Quest\Exception\UnknownMessageException;
use Bot\Service\HttpClientService;
use Bot\Service\QuestProgressService;

final class QuestRunWorker implements WorkerInterface
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

    public function run(WebhookUpdate $webhookUpdate): void
    {
        $userId = $webhookUpdate->message->from->id;
        $progress = $this->questProgressService->loadProgressStash($this->quest->getHash());

        if (!$progress->userHasProgress($userId)) {
            $step = $this->quest->getStepById($this->quest->getUnknownCommandStep());
            $this->sendCommandsByStep(
                $step,
                $userId,
                $this->quest->getButtonFormatStrategy(),
                $this->httpClientService
            );

            return;
        }

        $step = $this->quest->getStepById($progress->getUserCurrentStep($userId));
        $moveToStep = $step->getStepIdToMoveByMessage($webhookUpdate->message->text);
        $step = $this->quest->getStepById($moveToStep);

        $this->sendCommandsByStep(
            $step,
            $userId,
            $this->quest->getButtonFormatStrategy(),
            $this->httpClientService
        );

        $progress->updateProgress($userId, $step);
    }
}