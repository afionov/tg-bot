<?php

namespace Bot\Mode\Quest\Entity\Step\Content;

use Bot\Service\HttpClient\Command\Command;
use Bot\Service\HttpClient\Command\SendSticker;

final class Sticker extends Content
{
    public function getCommand(string|int $chatId): Command
    {
        return new SendSticker($chatId, $this->value);
    }

    public function getType(): ContentTypeEnum
    {
        return ContentTypeEnum::Sticker;
    }
}