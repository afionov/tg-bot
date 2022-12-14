<?php

namespace Bot\Mode\Quest\Content;

use Bot\Service\HttpClient\Command\Command;
use Bot\Service\HttpClient\Command\SendMessage;

final class Text extends Content
{
    public function getCommand(string|int $chatId): Command
    {
        return new SendMessage($chatId, $this->value);
    }

    public function getType(): ContentTypeEnum
    {
        return ContentTypeEnum::Text;
    }
}