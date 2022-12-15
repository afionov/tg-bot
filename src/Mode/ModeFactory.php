<?php

namespace Bot\Mode;

use Bot\DI\ServiceLocator;

final class ModeFactory
{
    public static function make(string $modeClassName): ModeInterface
    {
        return ServiceLocator::get($modeClassName);
    }
}