<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Mail\TransactionSuccess;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Service\UploadFileService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;


use function Laravel\Prompts\select;

class TransactionController extends Controller
{
    public function __construct(public UploadFileService $uploadFileService)
    {
    }
    public function booking($slug, $id)
    {
        $event = Event::with('ticket')->where('slug', $slug)->firstOrFail();
        $ticket = Ticket::where('event_id', $event->id)->findOrFail($id);

        return view('customers.booking', compact('event', 'ticket'));
    }
    public function processBooking(Request $request, $slug)
    {
        $request->validate([
            'validitydate' => 'required',
            'qty' => 'required|min:1|max:4',
            'contact_name' => 'required|min:1',
            'contact_number' => 'required',
            'contact_email' => 'required|email',
            'identity_number' => 'required|numeric',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $price = $ticket->price;
        $total_price = $request->qty * $price;



        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'event_id' => $request->event_id,
            'ticket_id' => $request->ticket_id,
            'validitydate' => $request->validitydate,
            'qty' => $request->qty,
            'total_price' => $total_price,
            'contact_name' => $request->contact_name,
            'contact_number' => $request->contact_number,
            'contact_email' => $request->contact_email,
            'visitor_name' => $request->visitor_name,
            'visitor_number' => $request->visitor_number,
            'visitor_email' => $request->visitor_email,
            'identity_number' => $request->identity_number,
            'status' => 'pending',
            'payment_due_time' => now()->addMinutes(30),
        ]);
        // dd($transaction);

        session()->put('transaction_id', $transaction->id);
        session()->put('event_slug', $slug);

        return redirect()->back()->with('success', 'Ticket Booked Successfully');
    }

    public function payment($slug, $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->validitydate = Carbon::parse($transaction->validitydate)->format('l, d F Y');
        $event = Event::where('slug', $slug)->firstOrFail();

        return view('customers.payment', compact('event', 'transaction'));
    }
    public function processPayment(Request $request, $transaction_id)
    {
        $transaction = Transaction::find($transaction_id);

        $request->validate([
            'payment_method' => 'required',
        ]);

        $transaction->update([
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order_id = $transaction->id . '-' . time();

        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $transaction->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->update([
            'snap_token' => $snapToken,
            'order_id' => $order_id,
        ]);

        return redirect()->route('customer.transactions.payment-detail', ['transaction_id' => $transaction_id]);
    }

    public function paymentDetail($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $event = Event::where('id', $transaction->event_id)->first();

        return view('customers.payment-detail', compact('transaction', 'event'));
    }

    public function success($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $eventName = Str::camel($transaction->ticket->event->name);

        function generateUniqueCode($eventName)
        {
            $code = '';
            do {
                $randomNumber = mt_rand(1000, 9999);
                $code = '#' . $eventName . $randomNumber;
            } while (Transaction::where('code', $code)->exists());

            return $code;
        }
        $uniqueCode = generateUniqueCode($eventName);
        $transaction->update([
            'status' => 'success',
            'code' => $uniqueCode,
            'payment_success' => now()
        ]);

        // Dapatkan email user yang sedang login
        $currentUserEmail = Auth::user()->email;

        // Kirim email ke user yang sedang login
        Mail::to($currentUserEmail)->send(new TransactionSuccess($transaction));
        return view('customers.success', compact('transaction'));
    }

    public function failed($transaction_id)
    {

        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->update([
            'status' => 'reject',
        ]);

        return view('customers.failed', compact('transaction'));
    }
    public function bookingHistory()
    {

        $transactionSuccess = Transaction::where('status', 'success')
            ->where('user_id', Auth::user()->id)
            ->get();
        $transactionPending = Transaction::where('status', 'pending')
            ->where('user_id', Auth::user()->id)
            ->get();
        $transactionReject = Transaction::where('status', 'reject')
            ->where('user_id', Auth::user()->id)
            ->get();

        // $otherEvent = Event::where('start_event', '>', now())
        //     ->get();

        $otherEvent = Event::all();
        $otherEvent = $otherEvent->map(function ($otherEvent) {
            $otherEvent->lowestPrice = Ticket::where('event_id', $otherEvent->id)->min('price');
            $otherEvent->description = Str::words($otherEvent->description, 10, '...');
            return $otherEvent;
        });

        return view('customers.history', compact('transactionSuccess', 'transactionPending', 'transactionReject', 'otherEvent'));
    }

    public function seeDetails($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);

        return view('customers.see-detail', compact('transaction'));
    }
}
