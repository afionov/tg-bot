<?php

namespace Bot\Mode\Quest\Entity\Step\Content;

use Bot\Service\HttpClient\Command\Command;
use Bot\Service\HttpClient\Command\SendImage;

final class Image extends Content
{
    public function getCommand(string|int $chatId): Command
    {
        return new SendImage($chatId, $this->value);
    }

    public function getType(): ContentTypeEnum
    {
        return ContentTypeEnum::Image;
    }
}