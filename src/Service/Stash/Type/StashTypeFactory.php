<?php

namespace Bot\Service\Stash\Type;

final class StashTypeFactory
{
    public static function make(ContentType $contentType): StashTypeInterface
    {
        return new $contentType();
    }
}