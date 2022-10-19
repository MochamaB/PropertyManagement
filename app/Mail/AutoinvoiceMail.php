<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AutoinvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice,$previousmonthsbalance,$readings,$parentutilsum,$total,$paymenttype;
    
    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public function __construct($invoice,$previousmonthsbalance,$readings,$parentutilsum,$total,$paymenttype)
    {
        $this->invoice = $invoice;
        $this->previousmonthsbalance = $previousmonthsbalance;
        $this->paymenttype = $paymenttype;
        $this->parentutilsum = $parentutilsum;
        $this->readings = $readings;
        $this->total = $total;
       

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->invoice->apartments->email,$this->invoice->apartments->name)
        ->subject($this->invoice->invoicetype.' Invoice for '.Carbon::parse( $this->invoice->invoicedate)->format('d M Y'))
                    ->view('emails.invoiceEmailView');
    }
}
