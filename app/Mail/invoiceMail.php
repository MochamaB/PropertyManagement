<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class invoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoicedetails,$previousmonthsbalance,$paymenttypes,$utilitycat,$readings,$watercharge,$paymentsinfo;
    
    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public function __construct($invoicedetails,$previousmonthsbalance,$paymenttypes,$utilitycat,$readings,$watercharge,$paymentsinfo)
    {
        $this->invoicedetails = $invoicedetails;
        $this->previousmonthsbalance = $previousmonthsbalance;
        $this->paymenttypes = $paymenttypes;
        $this->utilitycat = $utilitycat;
        $this->readings = $readings;
        $this->watercharge = $watercharge;
        $this->paymentsinfo = $paymentsinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, 'Machliz Focus Technology')
                    ->subject('Rent Invoice')
                    ->view('emails.invoiceEmailView');
    }
}
