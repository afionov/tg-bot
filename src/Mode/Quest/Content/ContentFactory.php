<?php

namespace Bot\Mode\Quest\Content;

final class ContentFactory
{
    public static function make(\Bot\Mode\Quest\DTO\Content $content): Content
    {
        $class = ContentTypeEnum::from($content->type);
        return match ($class) {
            ContentTypeEnum::Text => new Text($content->value),
            ContentTypeEnum::Image => new Image($content->value),
            ContentTypeEnum::Sticker => new Sticker($content->value),
        };
    }
}