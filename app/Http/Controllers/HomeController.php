<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::all()
            ->map(function ($events) {
                $events->lowestPrice = Ticket::where('event_id', $events->id)->min('price');
                $events->description = Str::words($events->description, 10, '...');
                return $events;
            });

        $eventRandom = Event::all()
            ->map(function ($events) {
                $events->lowestPrice = Ticket::where('event_id', $events->id)->min('price');
                $events->description = Str::words($events->description, 10, '...');
                return $events;
            })->random(10);

        return view('customers.home', compact('events','eventRandom'));
    }

    public function event()
    {
        return view('customers.event');
    }
}
