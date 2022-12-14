<?php

namespace Bot\Command;

use Bot\Command\Worker\InvokeStepWorker;

final class InvokeStepCommand implements CommandInterface
{
    public function getWorkerClassName(): string
    {
        return InvokeStepWorker::class;
    }
}