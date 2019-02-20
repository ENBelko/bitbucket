<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Jobs\EventOwnerMailJob;
use App\Mail\EventCreated as EventCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEventCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
        Mail::to($event->eventer->email)->send(new EventCreatedMail($event->eventer));
        /*отправка очереди организатору*/
        dispatch(new EventOwnerMailJob($event->eventer));
    }
}
