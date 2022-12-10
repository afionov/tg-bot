<?php

namespace Bot\Mode\Quest;

class Step
{
    /**
     * @param Entity\Step $step
     * @return static
     */
    public static function loadStep(Entity\Step $step): static
    {
        return new static();
    }
}