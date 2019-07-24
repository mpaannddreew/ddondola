<?php

namespace Ddondola\Observers;

use Ddondola\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \Ddondola\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->createCart();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Ddondola\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Ddondola\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \Ddondola\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \Ddondola\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
