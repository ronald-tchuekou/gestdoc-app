<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class RegisterUsers extends Notification
{
    use Queueable;

    private string $user_name;
    private string $user_firstname;
    private string $sup_name;
    private string $sup_firstname;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, string $firstName)
    {
        $user = Auth::user()->personne;
        $this->user_name = $name;
        $this->user_firstname = $firstName;
        $this->sup_name = $user->nom;
        $this->sup_firstname = $user->prenom;
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
                    ->subject('Inscription dans la plateforme gestDoc.')
                    ->line("Salut à vous Mr $this->user_name $this->user_firstname, Mr le maire $this->sup_name $this->sup_firstname du département de XXXX vous à ajouté dans la  plateforme GestDoc. Cliquer sur le lien suivant.")
                    ->action('Inscription', url("/register/{$notifiable->id}/{$notifiable->register_token}"))
                    ->line('Merci pour votre colaboration.');
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
