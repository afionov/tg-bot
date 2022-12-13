<?php

namespace Bot\Config;

use Exception;

/**
 * @property-read string $token
 * @property-read array $allowedUsernames
 */
final class BotConfig
{
    protected Config $config;

    public function __construct()
    {
        $path = realpath(__DIR__ . '/../../') . '/config/bot.json';
        $this->config = new Config($path);
    }

    /**
     * @throws Exception
     */
    public function __get(string $name)
    {
        return $this->config->$name ?? throw new Exception($name . ' - not found in ' . __CLASS__);
    }
}