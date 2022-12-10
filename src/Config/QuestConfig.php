<?php

namespace Bot\Config;

use Exception;

/**
 *
 */
class QuestConfig
{
    protected Config $config;

    protected const PATH = __DIR__.'/../../config/quest.json';

    public function __construct()
    {
        $this->config = new Config(self::PATH);
    }

    public function __get($name)
    {
        return $this->config->$name ?? throw new Exception($name . ' - not found in ' . __CLASS__);
    }

    public function  getHash()
    {
        return md5_file(self::PATH);
    }

    /**
     * @return array|mixed
     */
    public function toArray()
    {
        return $this->config->toArray();
    }
}