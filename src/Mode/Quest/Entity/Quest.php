<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;
use Bot\Service\Hydrator\EntityHydrator\Attribute\EntityCollection;

class Quest extends Entity
{
    /**
     * @var string
     */
    public string $start_id;

    /**
     * @var string
     */
    public string $final_id;

    /**
     * @var array
     */
    public array $commands;

    /**
     * @var string
     */
    public string $button_format_strategy;

    /**
     * @var string
     */
    public string $already_in_progress_step;

    /**
     * @var string
     */
    public string $unknown_command_step;

    /**
     * @var Step[]
     */
    #[EntityCollection(Step::class)]
    public array $steps;

    /**
     * @var string
     */
    public string $start_message;
}