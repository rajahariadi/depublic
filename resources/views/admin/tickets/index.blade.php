@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class="lni lni-ticket me-3"></i>Tickets Data</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary"><i
                                        class='bx bx-add-to-queue'></i>Add Ticket</a>
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
                                        <th>Event</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th class="col-lg-2">Action</th>
                                    </tr>
                                </thead>
                                {{-- DATA DARI DATA TABLE --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                ajax: '{{ route('admin.tickets.dt') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'event.name',
                        name: 'event.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'type',
                        name: 'type',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            return 'Rp.' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        orderable: true,
                        searchable: false
                    },
                ],
            });
        });
    </script>
@endsection
