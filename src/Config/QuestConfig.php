<?php

namespace Bot\Config;

/**
 * @property-read string $start_id
 * @property-read array $steps
 */
final class QuestConfig extends Config
{
    protected function getPath(): string
    {
        return __DIR__ . '/../../config/quest.json';
    }
}