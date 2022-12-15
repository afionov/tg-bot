<?php

namespace Bot\Command\Formatter\Button;

interface ButtonFormatStrategy
{
    public function format(array $buttonsArray): array;
}