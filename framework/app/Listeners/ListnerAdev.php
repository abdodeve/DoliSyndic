<?php

namespace App\Listeners;

use App\Events\EventGlobale;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListnerAdev
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
     * @param  EventGlobale  $event
     * @return void
     */
    public function handle(EventGlobale $event)
    {
        return $event ;
    }
}
