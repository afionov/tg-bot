<?php

namespace Bot\DTO\Chat;

use Bot\DTO\DTO;
use Bot\DTO\User;

final class ChatInviteLink extends DTO
{
    /**
     * The invite link.
     * If the link was created by another chat administrator,
     * then the second part of the link will be replaced with “…”.
     * @var string
     */
    public string $invite_link;

    /**
     * Creator of the link
     * @var User
     */
    public User $creator;

    /**
     * True,
     * if users joining the chat via the link need to be approved by chat administrators
     * @var bool
     */
    public bool $creates_join_request;

    /**
     * True, if the link is primary
     * @var bool
     */
    public bool $is_primary;

    /**
     * True, if the link is revoked
     * @var bool
     */
    public bool $is_revoked;

    /**
     * Optional.
     * Invite link name
     * @var string
     */
    public string $name;

    /**
     * Optional.
     * Point in time (Unix timestamp) when the link will expire or has been expired
     * @var int
     */
    public int $expire_date;

    /**
     *  Optional.
     * The maximum number of users that can be members of the chat simultaneously after joining
     * the chat via this invite link; 1-99999
     * @var int
     */
    public int $member_limit;

    /**
     * Optional.
     * Number of pending join requests created using this link.
     * @var int
     */
    public int $pending_join_request_count;
}