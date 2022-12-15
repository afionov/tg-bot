<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Command\Formatter\Button\ButtonFormatFactory;
use Bot\Command\Formatter\Button\ButtonFormatStrategy;
use Bot\Config\QuestConfig;

final class Quest
{
    protected string $startId;

    protected array $steps = [];

    protected string $questHash;

    protected ButtonFormatStrategy $formatStrategy;

    protected string $alreadyInProgressStepId;

    protected string $unknownCommandStep;

    public function __construct(QuestConfig $config)
    {
        $this->questHash = $config->getHash();
        $this->startId = $config->get('start_id');
        $this->formatStrategy = ButtonFormatFactory::make($config->get('button_format_strategy'));
        $this->alreadyInProgressStepId = $config->get('already_in_progress_step');
        $this->unknownCommandStep = $config->get('unknown_command_step');

        foreach ($config->get('steps') as $step) {
            $stepEntity = new Step($step);
            $this->steps[$stepEntity->getId()] = $stepEntity;
        }
    }

    public function getStartId(): string
    {
        return $this->startId;
    }

    public function getButtonFormatStrategy(): ButtonFormatStrategy
    {
        return $this->formatStrategy;
    }

    public function getHash(): string
    {
        return $this->questHash;
    }

    public function getUnknownCommandStep(): string
    {
        return $this->unknownCommandStep;
    }

    /**
     * @return string
     */
    public function getAlreadyInProgressStepId(): string
    {
        return $this->alreadyInProgressStepId;
    }

    public function getStepById(string|int $id): ?Step
    {
        return $this->steps[$id] ?? null;
    }
}