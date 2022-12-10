<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;

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
    public array|Step $steps;
}