<?php

namespace Bot\Mode;

use Bot\Config\QuestConfig;
use Bot\Entity\WebhookUpdate;
use Bot\Mode\Quest\Command\CommandFactory;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Exception\IllegalQuestStartException;
use Bot\Mode\Quest\Exception\UnknownMessageException;
use Bot\Mode\Quest\Progress;
use Bot\Mode\Quest\StepCollection;
use Bot\Mode\Quest\Worker\QuestRunWorker;
use Bot\Mode\Quest\Worker\WorkerBuilder;
use Bot\Service\HttpClientService;
use Bot\Service\Hydrator\HydratableInterface;
use Bot\Service\HydratorService;
use Bot\Service\LoggerService;
use Bot\Service\StashService;
use Psr\Http\Client\ClientExceptionInterface;

final class QuestMode implements ModeInterface
{
    protected Quest $entity;

    protected string $questHash;

    public function __construct(
        QuestConfig $config,
        protected HttpClientService $httpClient,
        protected StashService $stashService,
        protected LoggerService $loggerService,
        protected HydratorService $hydratorService
    ) {
        /**
         * @var Quest $entity
         */
        $entity = $this->hydratorService->hydrate(Quest::class, $config->toArray());
        $this->entity = $entity;
        $this->questHash = $config->getHash();
    }

    /**
     * @param WebhookUpdate $webhook
     * @return void
     * @throws ClientExceptionInterface
     * @throws IllegalQuestStartException
     * @throws UnknownMessageException
     */
    public function handleWebhook(HydratableInterface $webhook): void
    {
        $chatId = $webhook->message->from->id;
        $currentMessage = $webhook->message->text;

        $command = CommandFactory::make($currentMessage, $this->entity->commands);

        $workerBuilder = new WorkerBuilder(
            isset($command) ? $command->getWorkerClassName() : QuestRunWorker::class
        );
        $workerBuilder->setProgress(new Progress(
            $chatId,
            $this->stashService,
            $this->questHash
        ));
        $workerBuilder->setQuestEntity($this->entity);
        $workerBuilder->setCurrentMessage($currentMessage);
        $workerBuilder->setHttpClientService($this->httpClient);
        $workerBuilder->setChatId($chatId);

        $worker = $workerBuilder->build();

        $worker->run();
    }

    public function getModeHydrator(): HydratorService
    {
        return $this->hydratorService;
    }
}