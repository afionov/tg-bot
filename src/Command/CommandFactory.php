<?php

namespace Bot\Command;

use Bot\DI\ServiceLocator;

final class CommandFactory
{
    public static function make(string $command): CommandInterface
    {
        return ServiceLocator::get($command);
    }
}