@include('customers.component.head')

<body>
    <style>
        .custom-teks {
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            font-size: 25px;
        }

        .custom-teks2 {
            font-family: "Montserrat", sans-serif;
            font-size: 15px;
            color: #000;
        }

        .custom-button {
            color: #D081E9;
            background-color: #fff;
            border-color: #D081E9;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            padding: 5px 18px;
            font-size: 12px;
        }

        .custom-button:hover {

            color: #fff;
            background-color: #A103D3;
            border-color: #D081E9;
        }

        .custom-button2 {
            color: #fff;
            background-color: #A103D3;
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            padding: 5px 18px;
            font-size: 12px;

        }

        .custom-button3 {
            font-size: 25px;
            padding: 2px 10px;
            border-color: #fff;
            background: none;
            border: none;
        }

        .btn3 {
            font-size: 50px;
            padding: 2px 10px;
            font-family: "Montserrat", sans-serif;
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            color: inherit;
            cursor: pointer;

        }

        .btn3:hover,
        .btn3:focus {
            text-decoration: none;
            /* Optional: remove underline on hover/focus */
        }

        .card {
            flex: 0 0 auto;
            margin: 10px;

        }

        .card-img-top {
            width: 100%;
            height: 200px;

        }

        .card-body .card-text {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-family: "Montserrat", sans-serif;
        }

        .card-body .card-text .location-icon {
            margin-right: 8px;

        }

        .available-button {
            display: block;
            margin: 10px 0;
            padding: 10px 0;
            width: 100%;
            font-size: 1rem;
            background-color: #EAF2E2;
            color: #2A961D;
            border: 2px #EAF2E2;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;

        }

        .available-button:hover {
            color: #fff;
            background-color: #A103D3;
        }

        .footer {
            position: relative;
            background-color: #360146;
            padding: 50px 0;
            margin-top: 10px;

        }

        .footer-line {
            flex-grow: 1;
            height: 1px;
            background-color: #6B028D;
            margin-top: 60px;
            margin-right: 30px;
        }

        .color-accent {
            color: #fff;
        }

        .color-accent3 {
            color: #fff;
            font-weight: 400;
            font-family: "Montserrat", sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .footer .row .col-12.text-center {
            text-align: center;
        }

        .footer .row .col-12.mt-4.text-center p {
            text-align: center;
        }


        .flex-container {
            display: flex;
            align-items: center;
        }

        .flex-container img {
            margin-right: 10px;
            /* Atur jarak antara gambar dan teks */
        }

        .color-accent2 {
            color: #fff;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            font-size: 30px;
            margin: 0;
        }

        .input-search {
            font-family: "Montserrat", sans-serif;
            background-color: #fff;
            /* width: 200px; */
            border-radius: 10px;
        }

        .input-location {
            font-family: "Montserrat", sans-serif;
            background-color: #fff;
            /* width: 200px; */
            border-radius: 10px;
        }

        .card {
            width: 18rem;
        }

        .event-name-text {
            font-size: 20px;
        }

        .date-text {
            font-size: 20px;
        }

        @media (max-width: 767px) {

            .card {
                width: 10.5rem;
            }

            .card-body {
                padding: 0.5rem;
            }

            .card-body.card-text {
                font-size: 50px;
            }

            .card-body span {
                font-size: 10px;
            }

            .card-body p {
                font-size: 8px;
            }

            .card-body h2 {
                font-size: 10px;
            }

            .card-body span {
                font-size: 10px;
            }

            .card-text {
                font-size: 5px;
            }

            .text-p {
                font-size:
            }

            .card-img-top {
                width: 100%;
                height: 100px;
            }

            .available-button {
                font-size: 12px;
                width: 100%;
            }

            .available-button:hover {
                color: #fff;
                background-color: #A103D3;
            }


        }
    </style>

    @include('customers.component.navbar')

    <div class="container">
        <div class="d-flex p-3">
            <button class="btn text-secondary" onclick="window.location.href='{{ route('customer.home') }}'">Home</button>
            <img class="img-fluid" src="{{ asset('assets/image/chevron-compact-right.svg') }}" alt="">
            <button class="btn" onclick="window.location.href='{{ route('customer.events') }}'"
                style="color: #A103D3">Ticket</button>
        </div>
        <div class="d-flex">
            <div class="input-group me-2 justify-content-start">
                <form action="{{ route('customer.search') }}" method="GET">
                    <div class="d-flex input-search border">
                        <button class="btn" type="submit">
                            <img src="{{ asset('assets/image/search.svg') }}" alt="" width="20">
                        </button>
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control"
                            placeholder="Search Activities" style="border: none">
                    </div>
                </form>
            </div>
            <div class="input-group ms-2 justify-content-end">
                <form action="{{ route('customer.search') }}" method="GET">
                    <div class="d-flex input-location border">
                        <button class="btn" type="submit">
                            <img src="{{ asset('assets/image/Location.png') }}" alt="" width="20">
                        </button>
                        <input type="text" name="location" class="form-control" placeholder="Location"
                            value="{{ request('location') }}" style="border: none">
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="mt-4">
                <span class="fw-bold">All Events</span>
            </div>
            <div class="mt-4">

                <!-- Button Date trigger modal -->
                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                    data-bs-target="#exampleVerticallycenteredModal1" style="border-radius: 10px"> <i
                        class="bx bx-slider " style="color: #A103D3;  transform: rotate(-90deg);"></i>Filter</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal1" tabindex="-1" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Select Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="GET" action="{{ route('customer.search') }}">
                                <div class="modal-body">
                                    <label for="defaultFormControlInput" class="form-label">Select Category</label>
                                    <div class="input-group">
                                        <select class="form-control single-select" name="category">
                                            <option selected hidden value="">-- Select --</option>
                                            @foreach ($eventsCategories as $category)
                                                <option value=" {{ $category->name }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn text-white"
                                        style="background-color: #A103D3">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Button Date trigger modal -->
                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                    data-bs-target="#exampleVerticallycenteredModal2" style="border-radius: 10px"><i
                        class="bx bx-calendar-star" style="color: #A103D3"></i>Date</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal2" tabindex="-1" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Select Date</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="GET" action="{{ route('customer.search') }}">
                                <div class="modal-body">
                                    <label for="defaultFormControlInput" class="form-label">Event Start</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp" name="start_event"
                                            min="{{ Carbon\Carbon::today()->format('Y-m-d') }}">
                                    </div>
                                    <br>
                                    <label for="defaultFormControlInput" class="form-label">Event End</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp" name="end_event">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn text-white"
                                        style="background-color: #A103D3">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Button Price trigger modal -->
                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                    data-bs-target="#exampleVerticallycenteredModal3" style="border-radius: 10px"> <i
                        class="bx bx-purchase-tag" style="color: #A103D3"></i>Price</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleVerticallycenteredModal3" tabindex="-1" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Select Price</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="GET" action="{{ route('customer.search') }}">
                                <div class="modal-body">
                                    <label for="start_price" class="form-label">Start Price</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control rupiah" id="start_price"
                                            placeholder="Start Price" aria-describedby="defaultFormControlHelp"
                                            name="start_price">
                                    </div>
                                    <br>
                                    <label for="end_price" class="form-label">End Price</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control rupiah" id="end_price"
                                            placeholder="End Price" aria-describedby="defaultFormControlHelp"
                                            name="end_price">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn text-white"
                                        style="background-color: #A103D3">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <span class="fw-bold"> {{ $eventCount }} Results</span> All Events
        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($events as $event)
                <a href="{{ route('customer.event-detail', ['slug' => $event->slug]) }}">
                    <div class="card" style="border-radius: 15px;">
                        <img src="{{ Storage::url($event->image) }}" class="card-img-top p-2"
                            alt="Placeholder Image 1" style="border-radius: 20px;">
                        <div class="card-body">
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt location-icon"></i>
                                <span>{{ $event->location }} | <span class=""
                                        style="color: #A103D3">{{ \Carbon\Carbon::parse($event->start_event)->translatedFormat('l, d F Y') }}</span></span>
                            </p>
                            <h2 class="fw-bold event-name-text" style=" font-family:'Montserrat', sans-serif; ">
                                {{ $event->name }}
                            </h2>
                            <p>{{ $event->description }}</p>
                            <p><span class=" fw-bold date-text"
                                    style="font-family:'Montserrat', sans-serif; color: #A103D3">IDR
                                    {{ number_format($event->lowestPrice, 0, ',', '.') }}</span>/ 1
                                Person</p>
                            <button class="btn available-button">Tersedia</button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    @include('customers.component.footer')
    @include('customers.component.script')
</body>

</html>
