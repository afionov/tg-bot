<?php

namespace Bot\Helper\Formatter\Button;

interface ButtonFormatStrategy
{
    /**
     * @param non-empty-list<string> $buttonsArray
     * @return array
     */
    public function format(array $buttonsArray): array;
}