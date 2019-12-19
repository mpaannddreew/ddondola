<?php

namespace Activity\Events;


class ReviewUpdate extends NewReview
{
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'review.update';
    }
}
