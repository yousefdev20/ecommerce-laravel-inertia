<?php

namespace App\Listeners;

use App\Events\OrderConfirmation;
use App\Mail\Order\OrderReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderConfirmation $event): void
    {
        Mail::to($event->user->email)->send(new OrderReceived());
    }
}
