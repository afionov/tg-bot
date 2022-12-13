<?php

namespace Bot\Mode\Quest\Content;

enum ContentTypeEnum: string
{
    case Text = 'text';
    case Image = 'image';
    case Sticker = 'sticker';
}