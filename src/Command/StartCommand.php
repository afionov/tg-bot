<?php

namespace Bot\Command;

use Bot\Mode\Quest\Worker\StartQuestWorker;

final class StartCommand implements CommandInterface
{
    public function getWorkerClassName(): string
    {
        return StartQuestWorker::class;
    }
}