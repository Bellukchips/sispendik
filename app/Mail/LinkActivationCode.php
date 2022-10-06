<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkActivationCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$activation_code)
    {
        $this->email = $email;
        $this->name = $name;
        $this->activation_code = $activation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sispendikapps@gmail.com','Team Sispendik')
                    ->view('email-link-registration')
                    ->with(
                        [
                            'email' => $this->email,
                            'name' => $this->name,
                            'activation_code'=> $this->activation_code
                        ]
                    );
    }
}
