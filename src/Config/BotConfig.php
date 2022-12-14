<?php

namespace Bot\Config;

/**
 * @property-read string $token
 * @property-read string $mode
 * @property-read array $commands
 */
final class BotConfig extends Config
{
    protected function getPath(): string
    {
        return __DIR__ . '/../../config/bot.json';
    }
}