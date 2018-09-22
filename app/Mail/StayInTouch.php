<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StayInTouch extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $stayintouch;
    public function __construct($stayintouch)
    {
        //
        $this->stayintouch = $stayintouch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from($this->stayintouch['email'])
        ->replyTo($this->stayintouch['email'])
        ->subject('AmpleReads - Stay In Touch with You!')
        ->view('emails.staytouch');
    }
}
