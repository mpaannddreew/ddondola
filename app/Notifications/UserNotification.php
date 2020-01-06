<?php

namespace Ddondola\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Model|null
     */
    protected $actor;

    /**
     * @var Model|null
     */
    protected $subject;

    /**
     * @var
     */
    protected $type;

    /**
     * Create a new notification instance.
     * @param Model|null $actor
     * @param Model|null $subject
     * @param $type
     */
    public function __construct(Model $actor = null, Model $subject = null, $type)
    {
        $this->actor = $actor;
        $this->subject = $subject;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'actor' => $this->affiliate($this->actor),
            'subject' => $this->affiliate($this->subject),
            'type' => $this->type
        ];
    }

    private function affiliate(Model $affiliate = null)
    {
        return $affiliate ? [
            'id' => $affiliate->getKey(),
            'type' => get_class($affiliate)
        ] : null;
    }
}
