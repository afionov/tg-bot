<?php

namespace Bot\Mode\Quest\Entity\Step\Content;

use Bot\Service\HttpClient\Command\Command;

abstract class Content
{
    public function __construct(
        public string $value
    ) {
    }

    abstract public function getCommand(string|int $chatId): Command;

    abstract public function getType(): ContentTypeEnum;
}