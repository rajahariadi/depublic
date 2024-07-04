<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Service\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function __construct(public UploadFileService $uploadFileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['event_categories'] = EventCategory::all();
        return view('admin.events.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'event_category_id' => 'required',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'image' => 'required|extensions:jpg,png,jpeg',
            'highlight' => 'required|string',
            'start_event' => 'required',
            'end_event' => 'required',
        ]);

        try {
            $path = $this->uploadFileService->uploadFile($request->file('image'));

            Event::create([
                'name' => $request->name,
                'event_category_id' => $request->event_category_id,
                'description' => $request->description,
                'location' => $request->location,
                'image' => $path,
                'highlight' => $request->highlight,
                'start_event' => $request->start_event,
                'end_event' => $request->end_event,
                'slug' => Str::slug($request->name),
            ]);
            return redirect()->route('admin.events.index')->with('success', "Event Category Added");
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
        $event_categories = EventCategory::all();
        $data = Event::find($id);
        return view('admin.events.edit', compact('data', 'event_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'event_category_id' => 'required',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'highlight' => 'required|string',
            'start_event' => 'required',
            'end_event' => 'required',
        ]);

        try {

            $data = Event::find($id);

            if ($request->file('image') != null) {
                $path = $this->uploadFileService->uploadFile($request->file('image'));
            } else {
                $path = $data->image;
            }

            $data->update([
                'name' => $request->name,
                'event_category_id' => $request->event_category_id,
                'description' => $request->description,
                'location' => $request->location,
                'image' => $path,
                'slug' => Str::slug($request->name),
                'highlight' => $request->highlight,
                'start_event' => $request->start_event,
                'end_event' => $request->end_event,
            ]);
            return redirect()->route('admin.events.index')->with('success', "Event Updated");
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
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->back()->with('successDelete', 'Event deleted');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function dtEvent()
    {
        $data = Event::query()
            ->with('eventCategory');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                $button = '<form action=" ' . route('admin.events.destroy', $data->id)  . '" method="POST">
                    ' . @csrf_field() . '
                    ' . @method_field('DELETE') . '
                    <a class="btn btn-primary btn-md"
                    href=" ' . route('admin.events.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
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
