<?php

namespace Bot\Service;

final class StashService
{
    protected const STASH_PATH = __DIR__ . '/../../../../../../';

    public function load(string $name): StashService
    {
        $fileContent = file_get_contents(self::STASH_PATH . $name . '.json');
        if (false === $fileContent) {
            throw new \RuntimeException('Could not load stash file');
        }
        $fileContent = json_decode($fileContent, true);
        if (false === $fileContent) {
            throw new \RuntimeException('Could not decode stash file');
        }
    }

    public function __construct()
    {
    }
}