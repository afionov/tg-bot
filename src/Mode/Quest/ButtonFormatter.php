<?php

namespace Bot\Mode\Quest;

class ButtonFormatter
{
    public function format(array $array): array
    {
        $counter = 0;
        $key = 0;
        $result = [];

        foreach ($array as $value) {
            if ($counter % 2 === 0) {
                $key++;
            }

            $counter++;
            $result[$key][] = ['text' => $value];
        }

        return array_values($result);
    }
}