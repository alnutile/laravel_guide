<?php namespace Acme;

use Illuminate\Support\Facades\Log;

class ExampleEventHandler {

    /**
     * Handle user logout events.
     */
    public function example2Counter($state)
    {
        Log::info("Event Listener for Example 2 with Data");

        $state->total = $state->total + 100;
        var_dump(sprintf("From The queue listener state %s <br>", $state->total));
    }

    public function subscribe($events)
    {
        $events->listen('example2', 'Acme\ExampleEventHandler@example2Counter');
    }
}