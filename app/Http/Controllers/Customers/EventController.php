<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function events()
    {
        $events = Event::all()
            ->map(function ($events) {
                $events->lowestPrice = Ticket::where('event_id', $events->id)->min('price');
                $events->description = Str::words($events->description, 10, '...');
                return $events;
            });;
        $eventsCategories = EventCategory::all();
        $eventCount = Event::count();
        return view('customers.events', compact('events', 'eventCount', 'eventsCategories'));
    }

    public function eventDetail($slug)
    {
        $event = Event::with('ticket')->where('slug', $slug)->first();

        $ticket = Ticket::where('event_id', $event->id)->get();
        $ticket = $ticket->map(function ($ticket) {
            $ticket->description = Str::words($ticket->event->description, 10, '...');
            return $ticket;
        });

        $lowestPrice = Ticket::where('event_id', $event->id)->orderBy('price', 'asc')->first();

        $upcomingEvent = Event::where('start_event', '>', now())
            ->where('id', '!=', $event->id)
            ->get();
        $upcomingEvent = $upcomingEvent->map(function ($upcomingEvent) {
            $upcomingEvent->lowestPrice = Ticket::where('event_id', $upcomingEvent->id)->min('price');
            $upcomingEvent->description = Str::words($upcomingEvent->description, 10, '...');
            return $upcomingEvent;
        });

        // Ambil semua transaksi yang sudah berhasil dilakukan oleh user tersebut
        $successfulTransactions = Transaction::where('user_id', Auth::id())
            ->where('status', 'success')
            ->pluck('ticket_id')
            ->toArray();

        return view('customers.event-details', compact('event', 'ticket', 'lowestPrice', 'upcomingEvent', 'successfulTransactions'));
    }

    public function search(Request $request)
    {
        $eventOrlocation = $request->input('search');

        $event = $request->input('name');
        $location = $request->input('location');

        $categoryName  = $request->input('category');

        $startEvent = $request->input('start_event');
        $endEvent = $request->input('end_event');

        $firstPrice = $request->input('start_price');
        $secondPrice = $request->input('end_price');
        $startPrice = str_replace('.', '', $firstPrice);
        $endPrice = str_replace('.', '', $secondPrice);

        $events = Event::query();

        if ($eventOrlocation) {
            $events = $events->where(function ($query) use ($eventOrlocation) {
                $query->where('name', 'LIKE', "%{$eventOrlocation}%")
                    ->orWhere('location', 'LIKE', "%{$eventOrlocation}%");
            });
        }

        if ($event) {
            $events = $events->where('name', 'LIKE', "%{$event}%");
        }
        if ($location) {
            $events = $events->where('location', 'LIKE', "%{$location}%");
        }

        if ($categoryName) {
            $events = $events->whereHas('eventCategory', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            });
        }

        if ($startEvent && $endEvent) {
            $events = $events->whereBetween('start_event', [$startEvent, $endEvent]);
        } elseif ($startEvent) {
            $events = $events->where('start_event', '>=', $startEvent);
        } elseif ($endEvent) {
            $events = $events->where('end_event', '<=', $endEvent);
        }

        if ($startPrice && $endPrice) {
            $events = $events->whereHas('ticket', function ($query) use ($startPrice, $endPrice) {
                $query->whereBetween('price', [$startPrice, $endPrice]);
            });
        } elseif ($startPrice) {
            $events = $events->whereHas('ticket', function ($query) use ($startPrice) {
                $query->where('price', '>=', $startPrice);
            });
        } elseif ($endPrice) {
            $events = $events->whereHas('ticket', function ($query) use ($endPrice) {
                $query->where('price', '<=', $endPrice);
            });
        }

        $events = $events->get()->map(function ($event) {
            $event->lowestPrice = Ticket::where('event_id', $event->id)->min('price');
            $event->description = Str::words($event->description, 10, '...');
            return $event;
        });

        $eventCount = $events->count();
        $eventsCategories = EventCategory::all();
        return view('customers.events', compact('events', 'eventCount', 'eventsCategories'));
    }
}
