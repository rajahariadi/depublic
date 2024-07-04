<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $eventCount = Event::count();
        $ticketCount = Ticket::count();
        $transactiontCount = Transaction::count();
        $userCount = User::where('role', '!=', 'admin')->count();
        $topEvent = Event::select('events.*')
            ->join('tickets', 'events.id', '=', 'tickets.event_id')
            ->join('transactions', 'tickets.id', '=', 'transactions.ticket_id')
            ->selectRaw('events.*, SUM(transactions.qty) as total_qty')
            ->groupBy('events.id')
            ->orderByDesc('total_qty')
            ->take(3)
            ->get();
        $upcomingEvent = Event::where('start_event', '>', now())->orderBy('start_event', 'ASC')->get();
        return view('admin.dashboard.index', compact('eventCount', 'ticketCount', 'transactiontCount', 'userCount', 'topEvent', 'upcomingEvent'));
    }

    public function dtDashboard()
    {
        $data = Transaction::query()
            ->with('ticket', 'user')
            ->orderBy('created_at', 'desc');;


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('contact_visitor', function ($row) {
                return $row->contact_name . ' | ' . $row->visitor_name;
            })
            ->addColumn('event.name', function ($row) {
                return $row->ticket->event->name;
            })
            ->toJson();
    }
}
