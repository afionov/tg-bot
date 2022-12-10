<?php

namespace Bot\Log;

class Logger
{
    public static function log(string $text, array $parameters = []): void
    {
        file_put_contents(
            self::getLogsDirectory() . '/php-log.log',
            self::getLogMessagePrefix() . $text . '. Parameters: ' . print_r($parameters, true)
        );
    }

    public static function debug($fileName, $value)
    {
        file_put_contents(
            self::getLogsDirectory() . '/debug/' . $fileName . '.log',
            self::getLogMessagePrefix() . $value
        );
    }

    protected static function getLogsDirectory(): string
    {
        return realpath(__DIR__ . '/../../') . '/logs';
    }

    protected static function getLogMessagePrefix(): string
    {
        return date('Y-m-d H:i:s', time()) . ' : ';
    }
}