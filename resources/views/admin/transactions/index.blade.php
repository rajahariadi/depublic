@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-transfer me-2'></i>Transactions Data</h3>
            </div>
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div id="alert-container"></div>
                        </div>
                        <div class="col-sm-12">
                            <table id="myTable"
                                class="table table-striped table-bordered dataTable text-center align-middle"
                                style="width: 100%;" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Event</th>
                                        <th>Type</th>
                                        <th>Name <br>Contact | Visitor</th>
                                        <th>Email <br>Contact | Visitor</th>
                                        <th>Number <br>Contact | Visitor</th>
                                        <th>Identity Number</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Status</th>
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
                ajax: '{{ route('admin.transactions.dt') }}',
                columns: [{
                        data: 'user.name',
                        name: 'user.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'event.name',
                        name: 'event.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'ticket.type',
                        name: 'ticket.type',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'contact_visitor',
                        name: 'contact_visitor',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'contact_visitor_email',
                        name: 'contact_visitor_email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'contact_visitor_number',
                        name: 'contact_visitor_number',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'identity_number',
                        name: 'identity_number',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'qty',
                        name: 'qty',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            return 'Rp.' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data == 'pending') {
                                return '<span class="badge bg-warning">Pending</span>';
                            }
                            if (data == 'reject') {
                                return '<span class="badge bg-danger">Reject</span>';
                            }
                            if (data == 'success') {
                                return '<span class="badge bg-success">Complete</span>';
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

            window.rejectTransaction = function(id) {
                $.ajax({
                    url: '{{ url('/admin/transaction/reject') }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message);
                            dtTable.ajax.reload(null, false);
                            $('.modal').modal('hide');
                        }
                    }
                });
            }

            window.completeTransaction = function(id) {
                $.ajax({
                    url: '{{ url('/admin/transaction/complete') }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message);
                            dtTable.ajax.reload(null, false);
                            $('.modal').modal('hide');
                        }
                    }
                });
            }

            function showAlert(message) {
                var alertHtml = `
                    <div class="alert alert-success alert-dismissible" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                $('#alert-container').html(alertHtml);
            }
        });
    </script>
@endsection
