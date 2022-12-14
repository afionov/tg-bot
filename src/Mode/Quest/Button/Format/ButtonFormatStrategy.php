<?php

namespace Bot\Mode\Quest\Button\Format;

interface ButtonFormatStrategy
{
    public function format(array $buttonsArray): array;
}