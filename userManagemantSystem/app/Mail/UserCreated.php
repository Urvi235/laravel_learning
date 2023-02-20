<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email, $password, $user;
    public function __construct($user,$email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-created')->with([

            'email' => $this->email, 
            'name' => $this->user->name, 
            'password' => $this->password, 
        ]);
    }
}
