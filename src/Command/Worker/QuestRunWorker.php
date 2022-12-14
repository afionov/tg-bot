<?php

namespace Bot\Mode\Quest\Worker;

use Bot\Mode\Quest\Exception\UnknownMessageException;
use Bot\Mode\Quest\Step;
use Psr\Http\Client\ClientExceptionInterface;

final class QuestRunWorker extends Worker
{
    public function run()
    {
        if (!$this->progress->hasProgress()) {
            $step = $this->stepCollection->getStepById($this->quest->unknown_command_step);
            $this->runStep($step, '');

            return;
        }
        $step = $this->stepCollection->getStepById($this->progress->getCurrentStep());

        $this->runStep($step, $this->currentMessage);
    }

    /**
     * @param Step $step
     * @return void
     * @throws ClientExceptionInterface
     * @throws UnknownMessageException
     */
    protected function runStep(Step $step, $message): void
    {
        if (!empty($message)) {
            $moveToStep = $step->getStepIdToMoveByMessage($this->currentMessage);
            $step = $this->stepCollection->getStepById($moveToStep);

            if (!isset($step)) {
                throw new UnknownMessageException($message);
            }
        }

        $step->send($this->httpClientService, $this->chatId);
        $this->progress->updateProgress($step);
    }
}