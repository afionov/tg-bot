<?php

namespace Bot\Mode\Quest\Entity\Step\Content;

enum ContentTypeEnum: string
{
    case Text = 'text';
    case Image = 'image';
    case Sticker = 'sticker';
}