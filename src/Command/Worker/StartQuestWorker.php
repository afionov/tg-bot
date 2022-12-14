<?php

namespace Bot\Mode\Quest\Worker;

final class StartQuestWorker extends Worker
{
    public function run()
    {
        if ($this->progress->hasProgress()) {
            $step = $this->stepCollection->getStepById($this->quest->already_in_progress_step);
            $step->send($this->httpClientService, $this->chatId);
            return;
        }
        $step = $this->stepCollection->getStepById($this->quest->start_id);
        $step->send($this->httpClientService, $this->chatId);
        $this->progress->updateProgress($step);
    }
}