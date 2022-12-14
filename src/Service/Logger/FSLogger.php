<?php

namespace Bot\Service\Logger;

use DateTime;
use Psr\Log\AbstractLogger;

class FSLogger extends AbstractLogger
{
    public function log($level, $message, array $context = []): void
    {
        $filePath = $this->getLogsDirectory() . '/' . $level . '.log';
        $row = self::getLogMessagePrefix($level) . $message
            . '. Parameters: ' . var_export($context, true) . PHP_EOL . PHP_EOL;

        file_put_contents($filePath, $row, FILE_APPEND);
    }

    protected function getLogsDirectory(): string
    {
        return realpath(__DIR__ . '/../../') . '/logs';
    }

    protected function getLogMessagePrefix(string $level): string
    {
        $dateTime = new DateTime(timezone: new \DateTimeZone('Europe/Moscow'));
        return $dateTime->format('Y-m-d H:i:s') . ' : ' . strtoupper($level) . ' : ';
    }
}