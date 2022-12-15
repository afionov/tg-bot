<?php

namespace Bot\Mode\Quest\Entity\Step\Answer;

interface AnswerInterface
{
    public function getButtonText(): string;

    public static function fromArray(array $array): AnswerInterface;
}