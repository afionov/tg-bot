<?php

namespace Bot\Mode\Quest\DTO;

use Bot\DTO\DTO;
use Bot\Service\Hydrator\DTOHydrator\Attribute\ArrayOfDTO;

class Step extends DTO
{
    public string $id;

    /**
     * @var Content[]
     */
    #[ArrayOfDTO(Content::class)]
    public array $content;

    /**
     * @var Answer[]
     */
    #[ArrayOfDTO(Answer::class)]
    public array $answer;
}