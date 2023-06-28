<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $ticketsDetails;
    public $totalPrice;

    public function __construct($order, $ticketsDetails, $totalPrice)
    {
        $this->order = $order;
        $this->ticketsDetails = $ticketsDetails;
        $this->totalPrice = $totalPrice;
    }

    public function build()
    {
        return $this->view('checkoutConfirmation')
            ->subject('Checkout Confirmation');
    }
}

