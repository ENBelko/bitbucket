<?php

namespace App\Http\Controllers;

use App\Events\EventCreated;
use App\Jobs\EventOwnerMailJob;
use App\Models\Event;
use Illuminate\Http\{Request,Response};


class EventController extends Controller
{
    public function store(Request $request,Response $response)
    {
        $validated = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'middle-name' => 'required',
            'phone' => 'required|unique:events',
            'email' => 'required|unique:events'
        ]);
        $validated['education'] = $request->get('education');
        $validated['event_numb'] = $request->get('event');
        $validated['ip'] = $request->ip();
        $validated['utm'] = $request->get('utm_source');


        $applying = Event::create($validated);

        event(new EventCreated($applying));

        //dispatch(new EventOwnerMailJob($applying));

        return $response->setContent(['success' => 'Ваша заявка принята!']);

    }
}
