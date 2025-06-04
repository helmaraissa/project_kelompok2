<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AkunDiterimaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $username;
    public $password_plain;

    public function __construct($nama, $username, $password_plain)
    {
        $this->nama = $nama;
        $this->username = $username;
        $this->password_plain = $password_plain;
    }

    public function build()
    {
        return $this->subject('Pendaftaran Ekstrakurikuler Diterima')
                    ->markdown('emails.akun_diterima');
    }
}
