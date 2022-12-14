<?php

namespace Bot\Command;

use Bot\Mode\Quest\Worker\RestartWorker;

final class RestartCommand implements CommandInterface
{
    public function getWorkerClassName(): string
    {
        return RestartWorker::class;
    }
}