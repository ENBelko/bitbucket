<?php

namespace App\Jobs;

use App\Mail\OwnerEvents;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EventOwnerMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $eventer;

    public function __construct($eventer)
    {
        $this->eventer = $eventer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*типа опрделеяем имеил организатора*/
        $event_owner_email = 'login'.$this->eventer->event_numb.'@mail.ru';
        //dd($this->eventer->first()->name);
        Mail::to($event_owner_email)->send(new OwnerEvents($this->eventer));
    }
}
