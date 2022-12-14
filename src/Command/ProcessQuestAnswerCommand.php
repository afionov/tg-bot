<?php

namespace Bot\Command;

use Bot\Command\Worker\InvokeStepWorker;

final class ProcessQuestAnswerCommand implements CommandInterface
{
    public function getWorkerClassName(): string
    {
        return InvokeStepWorker::class;
    }
}