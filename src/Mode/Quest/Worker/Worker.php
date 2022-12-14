<?php

namespace Bot\Mode\Quest\Worker;

use Bot\Mode\Quest\Button\Format\ButtonFormatFactory;
use Bot\Mode\Quest\Entity\Quest;
use Bot\Mode\Quest\Progress;
use Bot\Mode\Quest\StepCollection;
use Bot\Service\HttpClientService;

abstract class Worker
{
    protected StepCollection $stepCollection;

    final public function __construct(
        protected Progress $progress,
        protected string|int $chatId,
        protected Quest $questEntity,
        protected string $currentMessage,
        protected HttpClientService $httpClientService
    ) {
        $buttonFormatStrategy = ButtonFormatFactory::make($this->questEntity->button_format_strategy);
        $this->stepCollection = StepCollection::createFromArray($this->questEntity->steps, $buttonFormatStrategy);
    }

    abstract public function run();
}