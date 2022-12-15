<?php

namespace Bot\Mode\Quest;

use Bot\Command\Formatter\Button\ButtonFormatStrategy;
use Bot\Mode\Quest\Entity\Step;
use Bot\Service\HttpClient\Command\Command as HttpCommand;
use Bot\Service\HttpClientService;

trait QuestStepsSenderTrait
{
    public function sendCommandsByStep(
        ?Step $step,
        string|int $userId,
        ButtonFormatStrategy $buttonFormatStrategy,
        HttpClientService $httpClientService
    ): void {
        if (!$step instanceof Step) {
            throw new \RuntimeException();
        }

        $commands = $step->generateCommands($userId, $buttonFormatStrategy);

        /**
         * @var HttpCommand $command
         */
        foreach ($commands as $command) {
            $httpClientService->sendCommand($command);
        }
    }
}