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

        .custom-button2:hover {

            color: #A103D3;
            background-color: #fff;
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

        nav ul li a {
            color: #888;
            /* Initial gray color */
            text-decoration: none;
            padding: 14px 20px;
            display: block;
            font-weight: bold;
            transition: all 0.3s;
        }

        nav ul li a.active,
        nav ul li a:hover {
            color: #6f42c1;
            /* Purple color when active or hovered */
            border-bottom: 3px solid #6f42c1;
        }

        .blur {
            filter: blur(8px);
        }

        .loginWrapper {
            position: fixed;
            top: 50%;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    </style>

    @include('customers.component.navbar')

    @if (Auth::user() == null)
        <div class="loginWrapper">
            <div class="position-absolute top-20 start-50 translate-middle mt-5">
                <div class="card-body p-3 bg-white" style="border-radius: 10px;">
                    <div class="d-flex">
                        <svg width="75" height="57" viewBox="0 0 75 57" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M50.3257 38.233L55.1639 33.0666L72.1668 48.9894C73.5935 50.3255 73.667 52.5651 72.3309 53.9918C70.9949 55.4184 68.7553 55.4919 67.3286 54.1559L50.3257 38.233Z"
                                fill="#360146" />
                            <circle cx="40.0776" cy="21.9743" r="19.9667" fill="#360146" />
                            <circle cx="40.0776" cy="21.9737" r="17.0087" fill="#FCF6E8" />
                            <path
                                d="M51.9119 15.9066C52.5968 15.6087 52.916 14.8081 52.5548 14.1544C51.4083 12.0793 49.7605 10.3148 47.7531 9.02736C45.7456 7.73991 43.4546 6.97829 41.0905 6.80189C40.3456 6.74631 39.7512 7.37041 39.7661 8.11715C39.781 8.86388 40.4004 9.44895 41.1438 9.52091C42.9709 9.69776 44.7369 10.3062 46.2929 11.3041C47.8489 12.302 49.1385 13.6533 50.0614 15.2401C50.4369 15.8857 51.227 16.2045 51.9119 15.9066Z"
                                fill="#FFD980" />
                            <path
                                d="M55.7231 43.288L60.5614 38.1215L72.1665 48.9895C73.5932 50.3255 73.6667 52.5652 72.3306 53.9918C70.9946 55.4185 68.755 55.492 67.3283 54.1559L55.7231 43.288Z"
                                fill="#6B028D" />
                            <circle cx="52.8605" cy="17.854" r="1.26773" fill="#FFD980" />
                            <path
                                d="M16.0438 0L19.0145 12.8231L31.8376 15.7938L19.0145 18.7645L16.0438 31.5876L13.0731 18.7645L0.25 15.7938L13.0731 12.8231L16.0438 0Z"
                                fill="#FFB400" />
                            <path
                                d="M33.9498 19.1215L35.6189 26.3264L42.8239 27.9956L35.6189 29.6647L33.9498 36.8697L32.2807 29.6647L25.0757 27.9956L32.2807 26.3264L33.9498 19.1215Z"
                                fill="#FFB400" />
                        </svg>
                        <div class="text-center">
                            <span><b>Want to see more details?</b></span>
                            <p class="text-muted">Login first to enter this page!</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn custom-button me-2">Sign In</a>
                        <a href="{{ route('register') }}" class="btn custom-button2">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <div class="container">

        <div class="d-flex p-3">
            <button class="btn text-secondary"
                onclick="window.location.href='{{ route('customer.home') }}'">Home</button>
            <img class="img-fluid" src="{{ asset('assets/image/chevron-compact-right.svg') }}" alt="">
            <button class="btn text-secondary"
                onclick="window.location.href='{{ route('customer.events') }}'">Ticket</button>
            <img class="img-fluid" src="{{ asset('assets/image/chevron-compact-right.svg') }}" alt="">
            <button class="btn" style="color: #A103D3">Event</button>
        </div>
        <div class="text-center">
            <img class="img-fluid" src="{{ Storage::url($event->image) }}" alt=" {{ $event->name }} "
                width="1000" style="border-radius: 25px">
        </div>

        <nav class="navbar mt-3 border-bottom justify-content-center">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link active text-muted" id=nav-summary" href="javascript:void(0)"
                        onclick="showSection('summary')">Summary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" id="nav-package" href="javascript:void(0)"
                        onclick="showSection('package')">Package</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" id="nav-location" href="javascript:void(0)"
                        onclick="showSection('location')">Location</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" id="nav-upcoming" href="javascript:void(0)"
                        onclick="showSection('upcoming')">Upcoming</a>
                </li>
            </ul>
        </nav>

        <section id="summary" class="section">
            <div class="d-flex mt-3">
                <p class="card-text">
                    <i class="fas fa-map-marker-alt location-icon"></i>
                    <span>{{ $event->location }} | <span style="color: #A103D3">
                            {{ \Carbon\Carbon::parse($event->start_event)->translatedFormat('l, d F Y') }}
                        </span> - </span>
                    <span style="color: #A103D3">
                        {{ \Carbon\Carbon::parse($event->end_event)->translatedFormat('l, d F Y') }}
                    </span>
                </p>
            </div>
            <div class="mt-1 mb-2">
                <p class="h1"><b>{{ $event->name }}</b></p>
            </div>
            <div class="{{ Auth::check() ? '' : 'blur' }}">
                <div class="d-flex justify-content-between">
                    <div class="me-5">
                        <p> {{ $event->description }} </p>
                    </div>
                    <div class="">
                        <p>Starting From</p>
                        <p class="h4 text-nowrap" style="color:#A103D3"><b>IDR
                                {{ number_format($lowestPrice->price, 0, ',', '.') }}</b></p>
                    </div>
                </div>
                <p class="h2"><b>Highlight</b></p>
                <ul>
                    @foreach (explode("\n", $event->highlight) as $highlight)
                        @if (!empty(trim($highlight)))
                            <li>{{ $highlight }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <div class="{{ Auth::check() ? '' : 'blur' }}">

            <section id="package" class="section" style="display:none;">
                <p class="h2 mt-3"><b>Choose Package</b></p>
                <div class=" package-list">
                    @foreach ($ticket as $tickets)
                        <div class="card package-item mt-4 mb-4" style="border-radius: 15px">
                            <div class="p-3">
                                <div class="d-flex justify-content-between ">
                                    <p class="h5"><b> {{ $tickets->type }} </b></p>
                                    <p class="h5 fw-50">Detail</p>
                                </div>
                                <div class="mt-2 border-bottom">
                                    <p> {{ $tickets->description }} </p>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <p class="h6" style="color: #A103D3"><b>IDR
                                            {{ number_format($tickets->price, 0, ',', '.') }}</b></p>
                                    @if (in_array($tickets->id, $successfulTransactions))
                                        @php
                                            $transactionId = \App\Models\Transaction::where('ticket_id', $tickets->id)
                                                ->where('user_id', Auth::id())
                                                ->where('status', 'success')
                                                ->pluck('id')
                                                ->first();
                                        @endphp
                                        <button class="btn btn-success"
                                            onclick="window.location.href='{{ route('customer.transactions.seeDetails', ['transaction_id' => $transactionId]) }}'">Booked</button>
                                    @else
                                        <a href="{{ route('customer.transaction.booking', ['slug' => $event->slug, 'id' => $tickets->id]) }}"
                                            class="btn text-white" {{ Auth::check() ? '' : 'disabled' }}
                                            style="background-color: #A103D3; border-radius: 10px;">Select Package</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="location" class="section" style="display:none;">
                <p class="h2 mt-3"><b>Location</b></p>
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('assets/location.png') }}" alt="location"
                        style="border-radius: 25px" width="700">
                    <div class="card" style="border-radius: 15px">
                        <div class="d-flex justify-content-between">
                            <div class="ms-3 mt-3 mb-3">
                                <button class="btn"
                                    onclick="window.location.href='https://www.google.co.id/maps/?q={{ $event->location }}'">
                                    <img class="me-3" src="{{ asset('assets/images/send.png') }}" alt=""
                                        width="20">
                                    Direction
                                </button>
                            </div>
                            <div class="m-3">
                                <button class="btn"
                                    onclick="window.location.href='https://www.google.co.id/maps/?q={{ $event->location }}'">
                                    <img src="{{ asset('assets/images/right-arrow.png') }}" alt=""
                                        width="10">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="upcoming" class="section" style="display:none">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto mt-4">
                        <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">
                            Upcoming Event
                        </h2>
                    </div>
                    <div class="col-auto d-flex align-items-center mt-3">
                        <button class="btn custom-button3 btn-outline-secondary me-2" id="prevBtn"
                            style="display: none;">&lt;</button>
                        <button class="btn custom-button3 btn-outline-secondary me-2" id="nextBtn">&gt;</button>
                    </div>
                </div>
                <div id="cardsContainer" class="mt-4">
                    @foreach ($upcomingEvent as $upcomingEvents)
                        <a href="{{ route('customer.event-detail', ['slug' => $upcomingEvents->slug]) }}">
                            <div class="card" style="width: 18rem; border-radius: 15px;">
                                <img src="{{ Storage::url($upcomingEvents->image) }}" class="card-img-top p-2"
                                    alt="{{ $upcomingEvents->name }}" style="border-radius: 20px;">
                                <div class="card-body">
                                    <p class="card-text">
                                        <i class="fas fa-map-marker-alt location-icon"></i>
                                        <span>{{ $upcomingEvents->location }} | <span class="date-text" style="color: #A103D3">
                                                {{ \Carbon\Carbon::parse($upcomingEvents->start_event)->translatedFormat('l, d F Y') }}
                                            </span></span>
                                    </p>
                                    <h2 class="fw-bold"
                                        style=" font-family:'Montserrat', sans-serif; font-size:20px;">
                                        {{ $upcomingEvents->name }}
                                    </h2>
                                    <p>{{ $upcomingEvents->description }}</p>
                                    <p class="card-text">
                                        <span class=" fw-bold date-text"
                                            style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR
                                            {{ number_format($upcomingEvents->lowestPrice, 0, ',', '.') }}
                                        </span>
                                        / 1 Person
                                    </p>
                                    <button class="btn available-button">Tersedia</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

        </div>
    </div>

    @include('customers.component.footer')

    @include('customers.component.script')
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

        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';

            // Remove active class from all nav links
            document.querySelectorAll('nav ul li a').forEach(navLink => {
                navLink.classList.remove('active');
            });

            // Add active class to the clicked nav link
            document.getElementById('nav-' + sectionId).classList.add('active');
        }
    </script>

</body>

</html>
