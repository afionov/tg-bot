<?php

namespace Bot\Mode\Quest\Worker;

final class RestartWorker extends Worker
{
    public function run()
    {
        $step = $this->stepCollection->getStepById($this->questEntity->start_id);
        $step->send($this->httpClientService, $this->chatId);
        $this->progress->updateProgress($step);
    }
}