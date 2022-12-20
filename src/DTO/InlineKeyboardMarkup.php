<?php

namespace Bot\DTO;

final class InlineKeyboardMarkup extends DTO
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var array
     */
    public array $inline_keyboard;
}