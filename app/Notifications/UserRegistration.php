<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserRegistration
 * @package App\Notifications
 */
class UserRegistration extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $token;

    /**
     * UserRegistration constructor.
     *
     * @param $user_name
     * @param $token
     */
    public function __construct($user_name, $token)
    {
        $this->name  = $user_name;
        $this->token = $token;
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
                    ->line('Добро пожаловать в автошколу, ' . $this->name)
                    ->action('Подтвердить регистрацию', url('/user/activation/' . $this->token))
                    ->line('Спасибо за ваш выбор!');
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
