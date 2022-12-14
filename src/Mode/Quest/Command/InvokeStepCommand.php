<?php

namespace Bot\Mode\Quest\Command;

use Bot\Mode\Quest\Worker\InvokeStepWorker;

final class InvokeStepCommand implements CommandInterface
{
    public function getWorkerClassName(): string
    {
        return InvokeStepWorker::class;
    }
}