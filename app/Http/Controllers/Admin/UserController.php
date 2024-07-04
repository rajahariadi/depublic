<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            return redirect()->route('admin.users.index')->with('success', "User Added");
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
        $data =  User::find($id);

        return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'role' => 'required',
        ]);

        try {

            $data = User::find($id);

            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            return redirect()->route('admin.users.index')->with('success', "User Updated");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user dari database
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users.index')->with('successDelete', 'User berhasil dihapus');
    }

    public function dtUser()
    {
        $currentUserId = auth()->id();
        $data = User::query()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data) use ($currentUserId) {
                $button = '<a class="btn btn-primary btn-md"
                        href="' . route('admin.users.edit', $data->id)  . '"><i class="bx bx-edit"></i>Edit</a>';

                if ($data->id !== $currentUserId) {
                    $button .= '<form action="' . route('admin.users.destroy', $data->id)  . '" method="POST" style="display:inline;">
                                ' . @csrf_field() . '
                                ' . @method_field('DELETE') . '
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
                                            <div class="modal-body">Are you sure want to delete this?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>';
                }

                return $button;
            })
            ->rawColumns(['Action'])
            ->toJson();
    }
}
