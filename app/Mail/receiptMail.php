<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class receiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiptdetails,$receiptpayments;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiptdetails, $receiptpayments)
    {
        $this->receiptdetails = $receiptdetails;
        $this->receiptpayments = $receiptpayments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, 'Machliz Focus Technology')
                    ->subject('Receipt Invoice')
                    ->view('emails.receiptEmailView');
    }
}
