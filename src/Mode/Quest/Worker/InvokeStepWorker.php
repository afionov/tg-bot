<?php

namespace Bot\Mode\Quest\Worker;

final class InvokeStepWorker extends Worker
{
    public function run()
    {
        if (!$this->progress->hasProgress()) {
            return;
        }
        $step = $this->stepCollection->getStepById($this->progress->getCurrentStep());
        $step->send($this->httpClientService, $this->chatId);
    }
}