<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function completeTransaction(Request $request, string $id)
    {
        $transaction = Transaction::find($id);
        $event = $transaction->ticket->event;
        $eventName = Str::camel($event->name);

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
            'status' => 'complete',
            'code' => $uniqueCode,
        ]);

        return response()->json(['success' => true, 'message' => 'Transaction Complete.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function rejectTransaction(Request $request, string $id)
    {
        $data = Transaction::find($id);

        $data->update([
            'status' => 'reject',
        ]);

        return response()->json(['success' => true, 'message' => 'Transaction rejected.']);
    }

    public function dtTransaction()
    {
        $data = Transaction::query()
            ->with('ticket', 'user')
            ->select('transactions.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('contact_visitor', function ($row) {
                if ($row->visitor_name != null) {
                    return $row->contact_name . ' | ' . $row->visitor_name;
                } else {
                    return $row->contact_name;
                }
            })
            ->addColumn('contact_visitor_email', function ($row) {
                if ($row->visitor_email != null) {
                    return $row->contact_email . ' | ' . $row->visitor_email;
                } else {
                    return $row->contact_email;
                }
            })
            ->addColumn('contact_visitor_number', function ($row) {
                if ($row->visitor_number != null) {
                    return $row->contact_number . ' | ' . $row->visitor_number;
                } else {
                    return $row->contact_number;
                }
            })
            ->addColumn('event.name', function ($row) {
                return $row->ticket->event->name;
            })
            ->addColumn('Action', function ($row) {
                if ($row->status == 'pending') {
                    return '';
                }

                if ($row->status == 'process') {
                    return '
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm bg-info text-white fw-bold" data-bs-toggle="modal" data-bs-target="#processModal' . $row->id . '">Process</button>
                    <!-- Modal -->
                    <div class="modal fade" id="processModal' . $row->id . '" tabindex="-1" aria-labelledby="processModalLabel' . $row->id . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="processModalLabel' . $row->id . '">Process Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Are you sure you want to process this?</div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn bg-danger text-white" onclick="rejectTransaction(' . $row->id . ')">Reject</button>
                                    <button type="button" class="btn bg-success text-white" onclick="completeTransaction(' . $row->id . ')">Complete</button>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                if ($row->status == 'success') {
                    return '
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm bg-success text-white" data-bs-toggle="modal" data-bs-target="#completeModal' . $row->id . '"><i class="bx bx-barcode"></i></button>
                    <!-- Modal -->
                    <div class="modal fade" id="completeModal' . $row->id . '" tabindex="-1" aria-labelledby="completeModalLabel' . $row->id . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="completeModalLabel' . $row->id . '">Booking Code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">Your Booking Code is <b>' . $row->code . '</b></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                if ($row->status == 'reject') {
                    return '';
                }

                return '';
            })
            ->rawColumns(['Action'])
            ->toJson();
    }
}
