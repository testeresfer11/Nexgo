<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RideCancelMail extends Mailable
{
    use Queueable, SerializesModels;
     public $driver;
        public $ride;
        public $booking;
        public $refundAmount;

    /**
     * Create a new message instance.
     */
    public function __construct($driver, $ride, $booking,$refundAmount)
    {
         $this->driver = $driver;
        $this->ride = $ride; // Assuming this is the ride details object
        $this->booking = $booking;
        $this->amount = $refundAmount;
    }

     public function build()
    {
      return $this->subject('Nexgo - Ride cancelled')
                ->view('emails.RideCancel')
                ->with([
                    'driver' => $this->driver,
                    'rideDetails' => $this->ride,
                    'booking' => $this->booking,
                    'amount' => $this->refundAmount,
                ]);
    }
}
