<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiAkunDiAktifkan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_users, $name, $email)
    {
        //
        $this->id_users = $id_users;
        $this->name = $name;
        $this->email = $email;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sispendikapps@gmail.com', 'Team Sispendik')
            ->view('notification-account-active')
            ->with(
                [
                    'id_users' => $this->id_users,
                    'name' => $this->name,
                    'email' => $this->email,
                ]
            );
    }
}
