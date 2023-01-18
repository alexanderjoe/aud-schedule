<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        $events = null;

        if($request->has(['start', 'end'])) {
            $start = $request->input('start');
            $end = $request->input('end');
            $events = CalendarEvent::whereBetween('start', [$start, $end])->get();
        } else {
            $events = CalendarEvent::all();
        }

        return EventResource::collection($events);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $event = CalendarEvent::create($params);

//        return new EventResource($event);
    }
}
