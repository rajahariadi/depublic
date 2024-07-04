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
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            font-size: 15px;
            padding: 7px 18px;
            color: #fff;
            background-color: #A103D3;
            border-color: #D081E9;

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


        .search-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .search-container input {
            padding-left: 30px;
            width: 100%;
        }

        .search-container .fa-search {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 300px;
            height: 150px;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            border-radius: 5px;
        }

        #hero {
            position: relative;
            background-color: #FDF9F0;
            padding: 50px 0;
        }

        .img-hero-container {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .img-hero {
            position: absolute;
            top: 50%;
            transform: translateY(-25%);
            right: 0;
            z-index: 1;
        }

        .img-hero1 {
            position: absolute;
            top: 43%;
            transform: translateY(-100%);
            right: 0;
            z-index: 1;
        }

        .content-container {
            position: relative;
            z-index: 2;
        }

        #cardsContainer {
            display: flex;
            overflow-x: scroll;
            scroll-behavior: auto;
        }

        .card {
            flex: 0 0 auto;
            margin: 10px;

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

        .card-body .card-text .date-text {
            color: #6B028D;

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
    </style>

    @include('customers.component.navbar')
    <div class="container">
        <div class="card">
            <div class="card-body" style="background-color: #FAFAFA">
                <div class="card-body border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Your Orders</h6>
                    </div>
                </div>

                <div class="card-body mb-4 mt-4 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex align-items-center p-2">
                        <h6 class="text-center p-2 bg-success text-white" style="border-radius: 25px; width: 200px;">
                            Payment Successfully</h6>
                    </div>
                    @foreach ($transactionSuccess as $success)
                        <div class="align-items-center border p-2 mb-3 " style="border-radius: 10px">
                            <div class="d-flex justify-content-between align-items-center border-bottom p-2">
                                <span>Order ID: {{ $success->id }}</span>
                                <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $success->id }}">
                                    &or;
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $success->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Pick an
                                                        Action</b></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex p-2 justify-content-between border-bottom">
                                                    <h6> See Details</h6>
                                                    <button class="btn"
                                                        onclick="window.location.href='{{ route('customer.transactions.seeDetails', ['transaction_id' => $success->id]) }}'">
                                                        <i class="bx bx-chevron-right"></i></button>
                                                </div>
                                                <div class="d-flex p-2 mt-2 justify-content-between border-bottom">
                                                    <h6>Download</h6>
                                                    <button id="download-btn{{ $success->id }}" class="btn">
                                                        <i class="bx bx-download"></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex p-2 mt-2">
                                                    <h6>&#11217; Need Help ?</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="me-2">
                                    <img class="mb-2 image-fluid" src="{{ asset('assets/ticket.png') }}" alt=""
                                        width="60" height="60">
                                    <span><b> {{ $success->ticket->event->name }} </b></span>
                                    <h6 class="ms-2">IDR {{ number_format($success->total_price, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="content{{ $success->id }}" hidden>
                            <div class="card-body mx-4">
                                <div class="container">
                                    <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
                                    <div class="row">
                                        <ul class="list-unstyled">
                                            <li class="text-black"> {{ $success->contact_name }} </li>
                                            <li class="text-muted mt-1"><span class="text-black">Order Id</span>
                                                {{ $success->order_id }} </li>
                                            <li class="text-black mt-1"> {{ $success->payment_success }} </li>
                                        </ul>
                                        <hr>
                                        <div class="col-xl-10 mb-3">
                                            <img src="{{ Storage::url($success->ticket->event->image) }}"
                                                alt="{{ $success->ticket->event->name }}" class="img-fluid"
                                                width="150">
                                            <span class="ms-2"> {{ $success->ticket->event->name }}</span>
                                        </div>
                                        <div class="col-xl-2">
                                            <p class="float-end">IDR
                                                {{ number_format($success->ticket->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <p>Qty</p>
                                        </div>
                                        <div class="col-xl-2">
                                            <p class="float-end">{{ $success->qty }}
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <p>Ticket Type</p>
                                        </div>
                                        <div class="col-xl-2">
                                            <p class="float-end">{{ $success->ticket->type }}
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <p>Tax</p>
                                        </div>
                                        <div class="col-xl-2">
                                            <p class="float-end">Include
                                            </p>
                                        </div>
                                        <hr style="border: 2px solid black;">
                                    </div>
                                    <div class="row text-black">

                                        <div class="col-xl-12">
                                            <p class="float-end fw-bold">Total: IDR
                                                {{ number_format($success->total_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <hr style="border: 2px solid black;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-body mb-4 mt-4 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex align-items-center p-2 ">
                        <h6 class="text-center p-2"
                            style="color: #D49600; background-color: #FCF6E8; border-radius: 25px; width: 200px;">
                            Waiting for Payment</h6>
                    </div>
                    @foreach ($transactionPending as $pending)
                        <div class="align-items-center border p-2 mb-3" style="border-radius: 10px">
                            <div class="d-flex justify-content-between align-items-center border-bottom p-2">
                                <span>Order ID: {{ $pending->id }}</span>
                                <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $pending->id }}">
                                    &or;
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $pending->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Pick an
                                                        Action</b></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex p-2 justify-content-between border-bottom">
                                                    <h6> See Details</h6>
                                                    <a
                                                        href=" {{ route('customer.transactions.seeDetails', ['transaction_id' => $pending->id]) }} ">
                                                        <h5>
                                                            >
                                                        </h5>
                                                    </a>
                                                </div>
                                                <div class="d-flex p-2 mt-2">
                                                    <h6>&#11217; Need Help ?</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class=" me-2">
                                    <img class="mb-2 image-fluid" src="{{ asset('assets/ticket.png') }}"
                                        alt="" width="60" height="60">
                                    <span><b>{{ $pending->ticket->event->name }}</b></span>
                                    <h6 class="ms-2">IDR {{ number_format($pending->total_price, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                            <button class="btn w-100 fw-bold" style="color: #E0ABF0; background-color:#F5F0F6"
                                onclick="window.location.href='{{ route('customer.transaction.payment', ['slug' => $pending->ticket->event->slug, 'transaction_id' => $pending->id]) }}' ">Complete
                                Payment In</button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="card-body mb-4 mt-4 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex align-items-center p-2 ">
                        <h6 class="text-center p-2 bg-danger text-white" style="border-radius: 25px; width: 200px;">
                            Payment Rejected</h6>
                    </div>
                    @foreach ($transactionReject as $reject)
                        <div class="align-items-center border p-2 mb-3" style="border-radius: 10px">
                            <div class="d-flex justify-content-between align-items-center border-bottom p-2">
                                <span>Order ID: {{ $reject->id }}</span>
                                <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $reject->id }}">
                                    &or;
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $reject->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Pick an
                                                        Action</b></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex p-2 justify-content-between border-bottom">
                                                    <h6> See Details</h6>
                                                    <a
                                                        href=" {{ route('customer.transactions.seeDetails', ['transaction_id' => $reject->id]) }} ">
                                                        <h5>
                                                            >
                                                        </h5>
                                                    </a>
                                                </div>
                                                <div class="d-flex p-2 mt-2">
                                                    <h6>&#11217; Need Help ?</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class=" me-2">
                                    <img class="mb-2 image-fluid" src="{{ asset('assets/ticket.png') }}"
                                        alt="" width="60" height="60">
                                    <span><b>{{ $reject->ticket->event->name }}</b></span>
                                    <h6 class="ms-2">IDR {{ number_format($reject->total_price, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}

            <section id="upcoming">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto mt-4">
                            <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">
                                Other Event
                            </h2>
                        </div>
                        <div class="col-auto d-flex align-items-center mt-3">
                            <button class="btn custom-button3 btn-outline-secondary me-2" id="prevBtn"
                                style="display: none;">&lt;</button>
                            <button class="btn custom-button3 btn-outline-secondary me-2" id="nextBtn">&gt;</button>
                            <!-- <button class="btn3 me-2">See All</button> -->
                            <a href="{{ route('customer.events') }}" class="custom-teks2 text-decoration-none">See
                                All</a>
                        </div>
                    </div>
                    <div id="cardsContainer" class="mt-4">
                        @foreach ($otherEvent as $events)
                            <a href="{{ route('customer.event-detail', ['slug' => $events->slug]) }}">
                                <div class="card" style="width: 18rem; border-radius: 15px;">
                                    <img src="{{ Storage::url( $events->image) }}" class="card-img-top p-2"
                                        alt="Placeholder Image 1" style="border-radius: 20px;">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <i class="fas fa-map-marker-alt location-icon"></i>
                                            <span>{{ $events->location }} | <span class="date-text"
                                                    style="color: #A103D3">
                                                    {{ \Carbon\Carbon::parse($events->start_event)->translatedFormat('l, d F Y') }}
                                                </span></span>
                                        </p>
                                        <h2 class="fw-bold"
                                            style=" font-family:'Montserrat', sans-serif; font-size:20px;">
                                            {{ $events->name }}
                                        </h2>
                                        <p>{{ $events->description }}</p>
                                        <p class="card-text"><span class=" fw-bold date-text"
                                                style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR
                                                {{ number_format($events->lowestPrice, 0, ',', '.') }}</span>/ 1
                                            Person</p>
                                        <button class="btn available-button">Tersedia</button>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>



    @include('customers.component.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        @foreach ($transactionSuccess as $success)
            document.getElementById('download-btn{{ $success->id }}').addEventListener('click', function() {
                var element = document.getElementById('content{{ $success->id }}');
                element.removeAttribute('hidden');
                html2pdf(element, {
                    margin: 10,
                    filename: 'transaction_{{ $success->order_id }}.pdf',
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                }).then(function() {
                    // Setelah PDF selesai dibuat, sembunyikan elemen kembali
                    element.setAttribute('hidden', 'true');
                });
            });
        @endforeach
    </script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>

    <script>
        $(document).ready(function() {
            var cardWidth = $(".card").outerWidth(true); // outerWidth includes margin
            var container = $("#cardsContainer");

            function updateButtons() {
                var maxScrollLeft = container[0].scrollWidth - container[0].clientWidth;
                var currentScrollLeft = container.scrollLeft();

                if (currentScrollLeft <= 0) {
                    $("#prevBtn").hide();
                } else {
                    $("#prevBtn").show();
                }

                if (currentScrollLeft >= maxScrollLeft) {
                    $("#nextBtn").hide();
                } else {
                    $("#nextBtn").show();
                }
            }

            $("#nextBtn").click(function() {
                container.animate({
                    scrollLeft: "+=" + cardWidth
                }, "slow", function() {
                    updateButtons();
                });
            });

            $("#prevBtn").click(function() {
                container.animate({
                    scrollLeft: "-=" + cardWidth
                }, "slow", function() {
                    updateButtons();
                });
            });

            updateButtons(); // Initialize button visibility
        });
    </script>

</body>

</html>
