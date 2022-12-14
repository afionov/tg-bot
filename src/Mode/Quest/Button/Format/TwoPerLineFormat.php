<?php

namespace Bot\Mode\Quest\Button\Format;

final class TwoPerLineFormat implements ButtonFormatStrategy
{
    public function format(array $buttonsArray): array
    {
        $counter = 0;
        $key = 0;
        $result = [];

        foreach ($buttonsArray as $value) {
            if ($counter % 2 === 0) {
                $key++;
            }

            $counter++;
            $result[$key][] = ['text' => $value];
        }

        return array_values($result);
    }
}