<?php

namespace Bot\Mode;

use Bot\DI\ServiceLocator;

final class ModeFactory
{
    public static function make(string $modeClassName)
    {
        return ServiceLocator::get($modeClassName);
    }
}