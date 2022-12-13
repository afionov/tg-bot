<?php

namespace Bot\Mode\Quest\Answer;

interface AnswerInterface
{
    public function getButtonText(): string;

    public static function createFromEntity(\Bot\Mode\Quest\Entity\Answer $answer);
}