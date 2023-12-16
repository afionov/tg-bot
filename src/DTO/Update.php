<?php

namespace Bot\DTO;

use Bot\DTO\Chat\ChatJoinRequest;
use Bot\DTO\Chat\ChatMember\ChatMemberUpdated;
use Bot\DTO\Poll\Poll;
use Bot\DTO\Poll\PollAnswer;

/**
 * Represents an incoming update. <br>
 * At most one of the optional parameters can be present in any given update.
 */
class Update extends DTO
{
    /**
     * The update's unique identifier.<br>
     * Update identifiers start from a certain positive number and increase sequentially.
     * This ID becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates
     * or to restore the correct update sequence, should they get out of order.
     * If there are no new updates for at least a week, then identifier of the next update will be chosen randomly
     * instead of sequentially.
     * @var int
     */
    public int $update_id;

    /**
     * <i>Optional</i><br>
     * New incoming message of any kind - text, photo, sticker, etc.
     * @var Message
     */
    public Message $message;

    /**
     * <i>Optional</i><br>
     * New version of a message that is known to the bot and was edited
     * @var Message
     */
    public Message $edited_message;

    /**
     * <i>Optional</i><br>
     * New incoming channel post of any kind - text, photo, sticker, etc.
     * @var Message
     */
    public Message $channel_post;

    /**
     * <i>Optional</i><br>
     * New version of a channel post that is known to the bot and was edited
     * @var Message
     */
    public Message $edited_channel_post;

    /**
     * <i>Optional</i><br>
     * New incoming inline query
     * @var InlineQuery
     */
    public InlineQuery $inline_query;

    /**
     * <i>Optional</i><br>
     *	The result of an inline query that was chosen by a user and sent to their chat partner.
     * Please see telegram documentation on the feedback collecting for details on how to enable these updates for your bot.
     * @var ChosenInlineResult
     */
    public ChosenInlineResult $chosen_inline_result;

    /**
     * <i>Optional</i><br>
     * New incoming callback query
     * @var CallbackQuery
     */
    public CallbackQuery $callback_query;

    /**
     * <i>Optional</i><br>
     * New incoming shipping query. Only for invoices with flexible price
     * @var ShippingQuery
     */
    public ShippingQuery $shipping_query;

    /**
     * <i>Optional</i><br>
     * New incoming pre-checkout query. Contains full information about checkout
     * @var PreCheckoutQuery
     */
    public PreCheckoutQuery $pre_checkout_query;

    /**
     * <i>Optional</i><br>
     * New poll state.
     * Bots receive only updates about stopped polls and polls, which are sent by the bot
     * @var Poll
     */
    public Poll $poll;

    /**
     * <i>Optional</i><br>
     * A user changed their answer in a non-anonymous poll.
     * Bots receive new votes only in polls that were sent by the bot itself.
     * @var PollAnswer
     */
    public PollAnswer $poll_answer;

    /**
     * <i>Optional</i><br>
     * The bot's chat member status was updated in a chat.
     * For private chats, this update is received only when the bot is blocked or unblocked by the user.
     * @var ChatMemberUpdated
     */
    public ChatMemberUpdated $my_chat_member;

    /**
     * <i>Optional</i><br>
     * A chat member's status was updated in a chat.
     * The bot must be an administrator in the chat
     * and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
     * @var ChatMemberUpdated
     */
    public ChatMemberUpdated $chat_member;

    /**
     * <i>Optional</i><br>
     * A request to join the chat has been sent.
     * The bot must have the can_invite_users administrator right in the chat to receive these updates.
     * @var ChatJoinRequest
     */
    public ChatJoinRequest $chat_join_request;
}