<?php

namespace Bot\Config;

final class QuestConfig extends Config
{
    protected function getPath(): string
    {
        return __DIR__ . '/../../config/quest.json';
    }
}