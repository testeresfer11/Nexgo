<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingDeclinedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $ride;
    protected $booking;
    protected $user;

   public function __construct($ride, $booking, $user)
    {
        $this->ride = $ride;
        $this->booking = $booking;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.booking_declined')
                    ->with([
                        'ride' => $this->ride,
                        'booking' => $this->booking,
                        'user' => $this->user,
                    ]);
    }
}

