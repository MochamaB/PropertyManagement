<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class receiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payments,$receiptdetails,$receiptpayments,$parentutilsum;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payments,$receiptdetails, $receiptpayments,$parentutilsum)
    {
        $this->payments = $payments;
        $this->receiptdetails = $receiptdetails;
        $this->receiptpayments = $receiptpayments;
        $this->parentutilsum = $parentutilsum;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->receiptdetails->apemail,$this->receiptdetails->name)
        ->subject($this->receiptdetails->paymentitem.' Payment for '.Carbon::parse( $this->receiptdetails->invoicedate)->format('d M Y'))
                    ->view('emails.receiptEmailView');
    }
}
