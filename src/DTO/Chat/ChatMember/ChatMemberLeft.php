<?php

namespace Bot\DTO\Chat\ChatMember;

use Bot\DTO\DTO;
use Bot\DTO\User;

class ChatMemberLeft extends DTO
{
    /**
     * The member's status in the chat, always “left”
     * @var string
     */
    public string $status;

    /**
     * Information about the user
     * @var User
     */
    public User $user;
}