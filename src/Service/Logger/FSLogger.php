<?php

namespace Bot\Service\Logger;

use DateTime;
use DateTimeZone;
use Exception;
use Psr\Log\AbstractLogger;

class FSLogger extends AbstractLogger
{
    /**
     * @param $level
     * @param string|\Stringable $message
     * @param array $context
     * @return void
     * @throws Exception
     */
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

    /**
     * @param string $level
     * @return string
     * @throws Exception
     */
    protected function getLogMessagePrefix(string $level): string
    {
        $dateTime = new DateTime(timezone: new DateTimeZone('Europe/Moscow'));
        return $dateTime->format('Y-m-d H:i:s') . ' : ' . strtoupper($level) . ' : ';
    }
}