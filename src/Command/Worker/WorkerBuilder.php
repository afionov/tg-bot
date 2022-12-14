<?php

namespace Bot\Mode\Quest\Worker;

use Bot\Interfaces\BuilderInterface;
use Bot\Mode\Quest\DTO\Quest;
use Bot\Mode\Quest\Progress;
use Bot\Service\HttpClientService;

final class WorkerBuilder implements BuilderInterface
{
    protected Progress $progress;

    protected string|int $chatId;

    protected Quest $quest;

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
     * @param Quest $quest
     */
    public function setQuest(Quest $quest): void
    {
        $this->quest = $quest;
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
            $this->quest,
            $this->currentMessage,
            $this->httpClientService
        );
    }
}