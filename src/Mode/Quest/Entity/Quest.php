<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;
use Bot\Entity\Helper\Attribute\ArrayOf;

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
     * @var Step[]
     */
    #[ArrayOf(Step::class)]
    public array $steps;

    /**
     * @var string
     */
    public string $start_message;
}