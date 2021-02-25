<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PassForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $token)
    {
        $this->url = url('/reset-password/' . urlencode($token));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.pass-forgotEmail')
            ->subject('Réinitialisation de mot de passe.')
            ->replyTo('message@communedebanka.com', 'GestDoc')
            ->from('message@communedebanka.com', 'GestDoc')
            ->with([
                'url' => $this->url
            ]);
    }
}
