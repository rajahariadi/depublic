@extends('admin.index')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-cosmic">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Total Event</p>
                            <h4 class="my-1 text-white"> {{ $eventCount }} </h4>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Total Ticket</p>
                            <h4 class="my-1 text-white">{{ $ticketCount }}</h4>
                        </div>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-white">Total Transaction</p>
                            <h4 class="my-1 text-white"> {{ $transactiontCount }} </h4>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-kyoto">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <p class="mb-0 text-dark">Total Customers</p>
                            <h4 class="my-1 text-dark">{{ $userCount }}</h4>
                        </div>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-2">Top Event</h6>
                        </div>
                    </div>
                    <div id="carouselTopEvent" class="carousel slide pointer-event" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($topEvent as $topEvents)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="5000">
                                    <img src="{{ Storage::url($topEvents->image) }}" class="d-block w-100"
                                        alt=" {{ $topEvents->name }} " height="320">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselTopEvent" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselTopEvent" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-2">Upcoming Event</h6>
                        </div>
                    </div>
                    <div id="carouselUpcomingEvent" class="carousel slide pointer-event" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($upcomingEvent as $upcomingEvents)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="5000">
                                    <img src="{{ Storage::url($upcomingEvents->image) }}" class="d-block w-100"
                                        alt=" {{ $upcomingEvents->name }} " height="320">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselUpcomingEvent" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselUpcomingEvent" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-2">Recent Booking</h6>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Name <br>Contact | Visitor</th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Date Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    {{-- DATA DARI DATA TABLE --}}
                </table>
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
                ajax: '{{ route('admin.dashboard.dt') }}',
                columns: [{
                        data: 'contact_visitor',
                        name: 'contact_visitor',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'event.name',
                        name: 'event.name',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'ticket.type',
                        name: 'ticket.type',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'qty',
                        name: 'qty',
                        orderable: false,
                        searchable: true
                    },

                    {
                        data: 'total_price',
                        name: 'total_price',
                        orderable: false,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            return 'Rp.' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            var dateString = date.toLocaleDateString('id-ID', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            var timeString = date.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            }).replace(/\./g, ':');
                            return dateString + ' ' + timeString;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
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
                ],
            });
        });
    </script>
@endsection
