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
            align-items: center;
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
            height: 200px;
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
            flex-direction: column;
            align-items: center;
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
    </style>

    @include('customers.component.navbar')

    <!-- Section 1 -->
    <section id="hero">
        <div class="img-hero-container">
            <img src="{{ asset('design-system/assets/images/union1.png') }}" alt="" class="img-hero" />
            <img src="{{ asset('design-system/assets/images/union2.png') }}" alt="" class="img-hero1" />
        </div>
        <div class="container content-container">
            <div class=" justify-content-center">
                <div class="offset-lg-1 my-auto order-1">
                    <form action="{{ route('customer.search') }}" method="GET">
                        <div class="search-container">
                            <div class="d-flex input-search border">
                                <button class="btn" type="submit" style="background-color: #fff">
                                    <img src="{{ asset('assets/image/search.svg') }}" alt="" width="20">
                                </button>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search Activities" style="border: none">
                            </div>
                        </div>
                    </form>
                    <h2 class="custom-teks fw-bold mt-5 me-5">Depublic Event<br />Application</h2>
                    <a href="{{ route('customer.events') }}" class="btn custom-button2 mt-4">All Events</a>
                    <div class="swiper mySwiper mt-2">
                        <div class="swiper-wrapper">
                            @foreach ($eventRandom as $random)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url($random->image) }}" alt="{{$random->name}}">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Section 1 -->

    <!-- Section 2 -->
    <section id="upcoming">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto mt-4">
                    <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">Upcoming Event
                    </h2>
                </div>
                <div class="col-auto d-flex align-items-center mt-3">
                    <button class="btn custom-button3 btn-outline-secondary me-2" id="prevBtn"
                        style="display: none;">&lt;</button>
                    <button class="btn custom-button3 btn-outline-secondary me-2" id="nextBtn">&gt;</button>
                    <!-- <button class="btn3 me-2">See All</button> -->
                    <a href="{{ route('customer.events') }}" class="custom-teks2 text-decoration-none">See All</a>
                </div>
            </div>
            <div id="cardsContainer" class="mt-4">
                @foreach ($events as $event)
                    <a href="{{ route('customer.event-detail', ['slug' => $event->slug]) }}">
                        <div class="card" style="width: 18rem; border-radius: 15px;">
                            <img src="{{ Storage::url($event->image) }}" class="card-img-top p-2"
                                alt="{{$event->name}}" style="border-radius: 20px;">
                            <div class="card-body">
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt location-icon"></i>
                                    <span>{{ $event->location }} | <span
                                            class="date-text" style="color: #A103D3">{{ \Carbon\Carbon::parse($event->start_event)->translatedFormat('l, d F Y') }}</span></span>
                                </p>
                                <h2 class="fw-bold" style=" font-family:'Montserrat', sans-serif; font-size:20px;">
                                    {{ $event->name }}
                                </h2>
                                <p>{{ $event->description }}.</p>
                                <p class="card-text"><span class=" fw-bold date-text"
                                        style=" font-family:'Montserrat', sans-serif; font-size:20px;">IDR
                                        {{ number_format($event->lowestPrice, 0, ',', '.') }}</span>/ 1
                                    Person</p>
                                <button class="btn available-button">Tersedia</button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Akhir Section 2 -->

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
