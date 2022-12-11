<?php

namespace Bot\Config;

use Bot\Config\Exception\FieldNotFoundException;

final class QuestConfig
{
    protected Config $config;

    protected const PATH = __DIR__ . '/../../config/quest.json';

    public function __construct()
    {
        $this->config = new Config(self::PATH);
    }

    /**
     * @throws FieldNotFoundException
     */
    public function __get($name)
    {
        return $this->config->$name ?? throw new FieldNotFoundException($name, self::class);
    }

    public function  getHash(): string
    {
        return md5_file(self::PATH);
    }

    /**
     * @return array|mixed
     */
    public function toArray(): array
    {
        return $this->config->toArray();
    }
}