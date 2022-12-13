<?php

namespace Bot\Log;

class Logger
{
    public static function log(string $text, array $parameters = []): void
    {
        file_put_contents(
            self::getLogsDirectory() . '/php-log.log',
            self::getLogMessagePrefix() . $text . '. Parameters: ' . var_export($parameters, true) . PHP_EOL,
            FILE_APPEND
        );
    }

    public static function debug(string $fileName, mixed $value): void
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
        date_default_timezone_set('Europe/Moscow');
        return date('Y-m-d H:i:s', time()) . ' : ';
    }
}