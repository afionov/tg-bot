<?php

namespace Bot\Mode\Quest\Button\Format;

final class ButtonFormatFactory
{
    public static function make($buttonFormatStrategyClassName): ?ButtonFormatStrategy
    {
        return new $buttonFormatStrategyClassName();
    }
}