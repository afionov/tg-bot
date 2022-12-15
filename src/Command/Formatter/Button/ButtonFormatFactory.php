<?php

namespace Bot\Command\Formatter\Button;

final class ButtonFormatFactory
{
    public static function make(string $buttonFormatStrategyClassName): ?ButtonFormatStrategy
    {
        return new $buttonFormatStrategyClassName();
    }
}