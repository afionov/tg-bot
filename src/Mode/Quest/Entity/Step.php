<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;

class Step extends Entity
{
    public string $id;

    /**
     * @var array|Content
     * @psalm-var list<Content>
     */
    public array|Content $content;

    /**
     * @var
     */
    public array|Answer $answer;
}