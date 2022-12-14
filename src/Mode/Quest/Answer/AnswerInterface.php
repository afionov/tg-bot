<?php

namespace Bot\Mode\Quest\Answer;

interface AnswerInterface
{
    public function getButtonText(): string;

    public static function createFromDTO(\Bot\Mode\Quest\DTO\Answer $answer);
}