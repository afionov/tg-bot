<?php

namespace Bot\Command;

use Bot\DI\ServiceLocator;

final class CommandFactory
{
    public static function make(string $command): Command
    {
        return ServiceLocator::get($command);
    }
}