<?php

namespace Bot\Mode;

use Bot\Config\QuestConfig;
use Bot\Entity\Helper\Hydrator;
use Bot\Entity\WebhookUpdate;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Exception\IllegalQuestStartException;
use Bot\Mode\Quest\Progress;
use Bot\Mode\Quest\Step;
use Bot\Service\HttpClientService;
use Bot\Service\StashService;

final class QuestMode implements ModeInterface
{
    protected Quest $entity;

    protected string $questHash;

    protected Progress $progress;

    public function __construct(
        QuestConfig $config,
        protected HttpClientService $httpClient,
        protected StashService $stashService
    ) {
        $this->entity = Hydrator::hydrate(new Quest(), $config->toArray());
        $this->questHash = $config->getHash();
    }

    /**
     * @throws IllegalQuestStartException
     */
    public function handleWebhook(WebhookUpdate $webhook)
    {
        $this->progress = new Progress(
            $webhook->message->from->username,
            $this->stashService,
            $this->questHash
        );

        $currentMessage = $webhook->message->text;

        if (!$this->progress->hasProgress()) {
            if ($currentMessage !== $this->entity->start_message) {
                throw new IllegalQuestStartException($currentMessage);
            }

            $this->runQuest();

            return;
        }

        $this->runStep($this->progress->getCurrentStep(), $currentMessage);
    }

    public function runQuest()
    {
        $startStep = $this->entity->steps[$this->entity->start_id];
        $this->runStep($startStep);
    }

    public function runStep(Step $step, string $currentMessage = '')
    {
        $step = empty($currentMessage) ? $step->send() : $step->move($currentMessage);
        $this->progress->updateProgress($step);
    }
}