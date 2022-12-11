<?php

namespace Bot\Mode;

use Bot\Config\QuestConfig;
use Bot\Entity\Helper\Hydrator;
use Bot\Entity\WebhookUpdate;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Progress;
use Bot\Mode\Quest\Step;
use Bot\Service\HttpClientService;
use Bot\Service\StashService;

final class QuestMode implements ModeInterface
{
    protected Quest $entity;

    protected string $questHash;

    protected Progress $progress;

    protected string $startMessage = '/start';

    public function __construct(
        QuestConfig $config,
        protected HttpClientService $httpClient
    )
    {
        $this->entity = Hydrator::hydrate(new Quest(), $config->toArray());
        $this->entity->mapArrayValue('steps', 'id');
    }

    public function handleWebhook(WebhookUpdate $webhook)
    {
        $this->progress = new Progress($webhook->message->from->username, new StashService());
        $currentMessage = $webhook->message->text;
        if (!$this->progress->hasProgress()) {
            if (!$currentMessage == $this->startMessage) {
                //TODO: Exception
                throw new \Exception();
            }
            $this->runQuest();
            return;
        }
        $this->runStep($this->progress->getCurrentStep(), $currentMessage);
    }

    public function runQuest()
    {
        $startStep = $this->entity->steps[$this->entity->start_id];
        $this->runStep($startStep, '', false);
    }

    public function runStep(Step $step, string $currentMessage, bool $checkMessage = true)
    {
        if (!$checkMessage) {
            $this->sendMessage($step);
            return;
        }

    }

    protected function recognizeUserMessage($userMessage)
    {

    }

    protected function sendMessage(Step $step)
    {

    }

    protected function moveStep(string $toStepId)
    {

    }
}