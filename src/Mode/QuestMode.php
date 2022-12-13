<?php

namespace Bot\Mode;

use Bot\Config\QuestConfig;
use Bot\Entity\Helper\Hydrator;
use Bot\Entity\WebhookUpdate;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Exception\IllegalQuestStartException;
use Bot\Mode\Quest\Exception\UnknownMessageException;
use Bot\Mode\Quest\Progress;
use Bot\Mode\Quest\Step;
use Bot\Mode\Quest\StepCollection;
use Bot\Service\HttpClientService;
use Bot\Service\StashService;
use Psr\Http\Client\ClientExceptionInterface;

final class QuestMode implements ModeInterface
{
    protected Quest $entity;

    protected string|int $chatId;

    protected string $questHash;

    protected ?Progress $progress;

    protected StepCollection $stepCollection;

    public function __construct(
        QuestConfig $config,
        protected HttpClientService $httpClient,
        protected StashService $stashService
    ) {
        $this->entity = Hydrator::hydrate(new Quest(), $config->toArray());
        $this->questHash = $config->getHash();
        $this->stepCollection = StepCollection::createFromArray($this->entity->steps);
    }

    /**
     * @param WebhookUpdate $webhook
     * @return void
     * @throws ClientExceptionInterface
     * @throws IllegalQuestStartException
     * @throws UnknownMessageException
     */
    public function handleWebhook(WebhookUpdate $webhook): void
    {
        $this->chatId = $webhook->message->from->username;
        $this->progress = new Progress(
            $this->chatId,
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

        $this->runStep(
            $this->stepCollection->getStepById($this->progress->getCurrentStep()),
            $currentMessage
        );
    }

    /**
     * @return void
     * @throws ClientExceptionInterface
     * @throws UnknownMessageException
     */
    protected function runQuest(): void
    {
        $startStep = $this->stepCollection->getStepById($this->entity->start_id);
        $this->runStep($startStep);
    }

    /**
     * @param Step $step
     * @param string $currentMessage
     * @return void
     * @throws UnknownMessageException
     * @throws ClientExceptionInterface
     */
    protected function runStep(Step $step, string $currentMessage = ''): void
    {
        if (!empty($currentMessage)) {
            $moveToStep = $step->getStepIdToMoveByMessage($currentMessage);
            $step = $this->stepCollection->getStepById($moveToStep);

            if (!isset($step)) {
                throw new UnknownMessageException($currentMessage);
            }
        }

        $step->send($this->httpClient, $this->chatId);
        $this->progress->updateProgress($step);
    }
}