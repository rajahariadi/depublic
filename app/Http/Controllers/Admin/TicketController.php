<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        return view('admin.tickets.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'type' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $price = $request->price;
        $rupiah = str_replace('.', '', $price);

        try {
            Ticket::create([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'type' => $request->type,
                'price' => $rupiah,
            ]);
            return redirect()->route('admin.tickets.index')->with('success', "Ticket Added");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
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
        $events = Event::all();
        $data = Ticket::find($id);
        return view('admin.tickets.edit', compact('events', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'event_id' => 'required',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        try {

            $data = Ticket::find($id);

            $price = $request->price;
            $rupiah = str_replace('.', '', $price);

            $data->update([
                'name' => $request->name,
                'event_id' => $request->event_id,
                'type' => $request->type,
                'price' => $rupiah,
            ]);

            return redirect()->route('admin.tickets.index')->with('success', "Ticket Updated");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();
            return redirect()->back()->with('successDelete', 'Ticket deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function dtTickets()
    {
        $data = Ticket::query()
            ->with('event');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                $button = '<form action=" ' . route('admin.tickets.destroy', $data->id)  . '" method="POST">
                ' . @csrf_field() . '
                ' . @method_field('DELETE') . '
                <a class="btn btn-primary btn-md"
                href=" ' . route('admin.tickets.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal' . $data->id . '"><i class="bx bx-trash"></i>Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal' . $data->id . '" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Are you sure want to delete this ?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>';
                return $button;
            })
            ->rawColumns(['Action'])
            ->toJson();
    }
}
