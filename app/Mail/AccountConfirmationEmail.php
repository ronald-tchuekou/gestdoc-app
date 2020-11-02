<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Member;
use App\User;
use Illuminate\Support\Facades\URL;

class AccountConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $data;
    public $member;
    public $user;
    public $route;
    public function __construct($data)
    {
        //
        $this->data = $data;
        $this->member = Member::where('email', $data['email'])->first();
        $this->user = $user = User::where('email', $data['email'])->first();
        $this->route = URL::to('/');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account_confirm');
    }
}
