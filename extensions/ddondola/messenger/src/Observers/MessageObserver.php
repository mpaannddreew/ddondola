<?php

namespace Messenger\Observers;

use Messenger\Events\NewMessage;
use Messenger\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \Messenger\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
//        broadcast(new NewMessage($message));
    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \Messenger\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \Messenger\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \Messenger\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \Messenger\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
