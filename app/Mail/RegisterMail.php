<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->url = url('/register/' . $user->id . '/' . urlencode($user->register_token));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.email')
            ->subject('Confirmation de compte et inscription.')
            ->replyTo('message@communedebanka.com', 'GestDoc')
            ->from('gmessage@communedebanka.com', 'GestDoc')
            ->with([
                'url' => $this->url,
                'lastName' => $this->user->personne->nom,
                'firstName' => $this->user->personne->prenom,
            ]);
    }
}
