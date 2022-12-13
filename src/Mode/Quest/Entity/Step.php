<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;
use Bot\Entity\Helper\Attribute\EntityCollection;

class Step extends Entity
{
    public string $id;

    /**
     * @var Content[]
     */
    #[EntityCollection(Content::class)]
    public array $content;

    /**
     * @var Answer[]
     */
    #[EntityCollection(Answer::class)]
    public array $answer;
}