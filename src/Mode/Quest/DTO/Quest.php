<?php

namespace Bot\Mode\Quest\DTO;

use Bot\DTO\DTO;
use Bot\Service\Hydrator\DTOHydrator\Attribute\ArrayOfDTO;

class Quest extends DTO
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
    #[ArrayOfDTO(Step::class)]
    public array $steps;

    /**
     * @var string
     */
    public string $start_message;
}