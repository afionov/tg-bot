<?php

namespace Bot\Mode\Quest\Command;

final class CommandFactory
{
    public static function make(string $command, array $commands): ?CommandInterface
    {
        $class = $commands[$command] ?? null;
        return isset($class) ? new $class() : null;
    }
}