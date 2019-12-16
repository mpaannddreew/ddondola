<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 06/05/2019
 * Time: 13:26
 */

Broadcast::channel('conversation.{conversation}', \Messenger\Broadcasting\ConversationChannel::class);
Broadcast::channel('online.{conversation}', \Messenger\Broadcasting\OnlineChannel::class);