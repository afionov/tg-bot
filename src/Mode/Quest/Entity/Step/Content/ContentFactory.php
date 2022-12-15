<?php

namespace Bot\Mode\Quest\Entity\Step\Content;

final class ContentFactory
{
    public static function make(string $contentType, string $contentValue): Content
    {
        $class = ContentTypeEnum::from($contentType);
        return match ($class) {
            ContentTypeEnum::Text => new Text($contentValue),
            ContentTypeEnum::Image => new Image($contentValue),
            ContentTypeEnum::Sticker => new Sticker($contentValue),
        };
    }
}