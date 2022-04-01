<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeeklyReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $adminName;

    protected $numberOfNewUsers;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $adminName, int $numberOfNewUsers)
    {
        $this->adminName = $adminName;
        $this->numberOfNewUsers = $numberOfNewUsers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('[' . env('APP_NAME') . '] ' . 'Weekly report')
            ->line('This mail sent from MYMUSIC application to ' . $this->adminName . '.')
            ->line('Here is the announcement of the number of users for the past week.')
            ->line('The number of new users: ' . $this->numberOfNewUsers . '.')
            ->action('Click here to checkout', route('admin.users.index'))
            ->line('End!');
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
            //
        ];
    }
}
