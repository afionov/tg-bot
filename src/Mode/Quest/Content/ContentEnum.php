<?php

namespace Bot\Mode\Quest\Content;

enum ContentEnum: string
{
    case Text = Text::class;
    case Image = Image::class;
    case Sticker = Sticker::class;
}