<?php

namespace Bot\Mode\Quest\Entity;

use Bot\Entity\Entity;

class Answer extends Entity
{
    public string $type;

    public string $value;

    public string $expectValue;

    public bool $strict = false;

    public string $move;

    public string $moveOnGood;

    public string $moveOnBad;

    public bool $useTextOnGoodMove = false;

    public bool $useTextOnBadMove = false;

    public bool $useTextOnMove = false;

    public string $textOnGoodMove = '';

    public string $textOnBadMove = '';

    public string $textOnMove = '';
}