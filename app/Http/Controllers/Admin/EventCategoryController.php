<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.event-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            EventCategory::create([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.event-categories.index')->with('success', "Event Category Added");
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
        $data =  EventCategory::find($id);

        return view('admin.event-category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {

            $data = EventCategory::find($id);

            $data->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.event-categories.index')->with('success', "Product Category Updated");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $data = EventCategory::findOrFail($id);

            $data->delete();

            return redirect()->back()->with('successDelete', "Product Category deleted");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function dtEventCategory()
    {
        $data = EventCategory::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) {
                $button = '<form action=" ' . route('admin.event-categories.destroy', $data->id)  . '" method="POST">
                    ' . @csrf_field() . '
                    ' . @method_field('DELETE') . '
                    <a class="btn btn-primary btn-md"
                    href=" ' . route('admin.event-categories.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>
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
