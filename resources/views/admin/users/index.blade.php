@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class="bx bx-group me-2"></i>Data User</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                                        class='bx bx-group'></i> Add User</a>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        @if (session('success'))
                            <div class="col-lg-4">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        @if (session('successDelete'))
                            <div class="col-lg-4">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('successDelete') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <table id="myTable"
                                class="table table-striped table-bordered dataTable text-center align-middle"
                                style="width: 100%;" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="col-lg-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animate-ModalSlide hidden" id="modalcenter">
        <div
            class="relative w-auto pointer-events-none sm:max-w-lg sm:my-0 sm:mx-auto z-[99] flex items-center h-[calc(100%-3.5rem)]">
            <form action="{{ route('admin.users.destroy', 'id') }}" method="POST" enctype="multipart/form-data">
                @method('DELETE')
                @csrf
                <div class="relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded"
                    style="left: 50%">
                    <div
                        class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid bg-slate-800">
                        <h6 class="mb-0 leading-4 text-base font-semibold text-slate-300 mt-0" id="staticBackdropLabel1">
                            Delete User</h6>
                        <button type="button"
                            class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                            aria-label="Close" data-fc-dismiss>&times;</button>
                    </div>
                    <div class="relative flex-auto p-4 text-slate-600 leading-relaxed">
                        <input type="hidden" name="user_id" id="user_id">
                        <p>Are you sure to delete?</p>
                    </div>
                    <div class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed">
                        <button type="button"
                            class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200  text-sm font-medium py-1 px-3 rounded mr-1 close"
                            data-fc-dismiss>Close</button>
                        <button type="submit"
                            class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200  text-sm font-medium py-1 px-3 rounded">Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('myscript')
    <script>
        $(document).ready(function() {
            var dtTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    className: 'text-center',
                    targets: ['_all']
                }],
                ajax: '{{ route('admin.users.dt') }}', // Correct AJAX URL
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'role',
                        name: 'role',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data == 'admin') {
                                return '<span class="badge bg-primary">Administrator</span>';
                            }
                            if (data == 'user') {
                                return '<span class="badge bg-info">User</span>';
                            }
                        }
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
@endsection
