<?php

namespace Bot\Mode\Quest\Worker;

use Bot\BuilderInterface;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Progress;
use Bot\Service\HttpClientService;

final class WorkerBuilder implements BuilderInterface
{
    protected Progress $progress;

    protected string|int $chatId;

    protected Quest $questEntity;

    protected string $currentMessage;

    protected HttpClientService $httpClientService;

    /**
     * @param Progress $progress
     */
    public function setProgress(Progress $progress): void
    {
        $this->progress = $progress;
    }

    /**
     * @param int|string $chatId
     */
    public function setChatId(int|string $chatId): void
    {
        $this->chatId = $chatId;
    }

    /**
     * @param Quest $questEntity
     */
    public function setQuestEntity(Quest $questEntity): void
    {
        $this->questEntity = $questEntity;
    }

    /**
     * @param string $currentMessage
     */
    public function setCurrentMessage(string $currentMessage): void
    {
        $this->currentMessage = $currentMessage;
    }

    /**
     * @param HttpClientService $httpClientService
     */
    public function setHttpClientService(HttpClientService $httpClientService): void
    {
        $this->httpClientService = $httpClientService;
    }

    public function __construct(
        protected string $workerName
    ) {
    }

    public function build()
    {
        $class = $this->workerName;
        return new $class(
            $this->progress,
            $this->chatId,
            $this->questEntity,
            $this->currentMessage,
            $this->httpClientService
        );
    }
}