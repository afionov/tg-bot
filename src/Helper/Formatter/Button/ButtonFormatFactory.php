<?php

namespace Bot\Helper\Formatter\Button;

final class ButtonFormatFactory
{
    /**
     *
     * @param class-string<ButtonFormatStrategy> $buttonFormatStrategyClassName
     * @return ButtonFormatStrategy
     */
    public static function make(string $buttonFormatStrategyClassName): ButtonFormatStrategy
    {
        return new $buttonFormatStrategyClassName();
    }
}