<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;
use Bot\Entity\Helper\Attribute\EntityCollection;

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
    #[EntityCollection(Step::class)]
    public array $steps;

    /**
     * @var string
     */
    public string $start_message;
}