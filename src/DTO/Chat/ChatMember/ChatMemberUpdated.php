<?php

namespace Bot\DTO\Chat\ChatMember;

use Bot\DTO\Chat\Chat;
use Bot\DTO\Chat\ChatInviteLink;
use Bot\DTO\DTO;
use Bot\DTO\User;

class ChatMemberUpdated extends DTO
{
    /**
     * Chat the user belongs to
     * @var Chat
     */
    public Chat $chat;

    /**
     * Performer of the action, which resulted in the change
     * @var User
     */
    public User $from;

    /**
     * Date the change was done in Unix time
     * @var int
     */
    public int $date;

    /**
     * Previous information about the chat member
     * @var ChatMember
     */
    public ChatMember $old_chat_member;

    /**
     * New information about the chat member
     * @var ChatMember
     */
    public ChatMember $new_chat_member;

    /**
     * Optional.
     * Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     * @var ChatInviteLink
     */
    public ChatInviteLink $invite_link;
}