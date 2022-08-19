<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class workorderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $workorder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($workorder)
    {
        $this->workorder = $workorder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, 'Machliz Focus Technology')
        ->subject('Work Order Request')
        ->view('emails.workorderEmailView');
    }
}
