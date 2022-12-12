<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;
use Bot\Entity\Helper\Attribute\ArrayOf;

class Step extends Entity
{
    public string $id;

    /**
     * @var Content[]
     */
    #[ArrayOf(Content::class)]
    public array $content;

    /**
     * @var Answer[]
     */
    #[ArrayOf(Answer::class)]
    public array $answer;
}