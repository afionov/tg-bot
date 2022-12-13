<?php

namespace Bot\Service\Stash\Type;

final class StashTypeFactory
{
    /**
     * @param ContentType $contentType
     * @return StashTypeInterface
     */
    public static function make(ContentType $contentType): StashTypeInterface
    {
        $class = $contentType->value;
        return new $class();
    }
}