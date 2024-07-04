@include('customers.component.head')

<body>
    <style>
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

        .ticket-selection {
            padding: 0.5rem 1rem;
        }

        .ticket-selection .quantity-control {
            display: flex;
            align-items: center;
        }

        .ticket-selection .quantity-control button {
            border: 1px solid #dee2e6;
            background: none;
            font-size: 1.25rem;
            width: 2.5rem;
            height: 2.5rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .ticket-selection .quantity-control input {
            width: 3rem;
            text-align: center;
            border: 1px solid #dee2e6;
            background: none;
            margin: 0 0.5rem;
            height: 2.5rem;
        }

        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(3px);
            z-index: 1000;
        }

        .loader {
            --d: 22px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            color: #A103D3;
            box-shadow:
                calc(1*var(--d)) calc(0*var(--d)) 0 0,
                calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
                calc(0*var(--d)) calc(1*var(--d)) 0 2px,
                calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
                calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
                calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
                calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
            animation: l27 1s infinite steps(8);
        }

        @keyframes l27 {
            100% {
                transform: rotate(1turn)
            }
        }

        .bookingSuccessWrapper {
            position: fixed;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(3px);
            z-index: 1000;
        }

        .bookingSuccess {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 200;
            height: 100;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .intl-tel-input {
            width: 100%;
        }
    </style>

    @include('customers.component.navbar')

    <div class="loader-wrapper" id="loaderWrapper">
        <div class="loader"></div>
    </div>

    @if (session('success'))
        <div class="bookingSuccessWrapper" id="bookingSuccess">
            <div class="container bookingSuccess">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <div class="card p-5 align-items-center border rounded">
                        <img src="{{ asset('assets/success.png') }}" alt="Logo" width="100" height="100"
                            class="">
                        <div class="text-center">
                            <h5> {{ session('success') }}</h5>
                            <p>You have 30 Minutes to pay the ticket!</p>
                        </div>
                        <div class="d-flex gap-2 p-2 justify-content-between align-items-center">
                            <a href=" {{ route('customer.home') }} " class="btn"
                                style="color: #A103D3; border-color:#A103D3;">Later</a>
                            <a href="{{ route('customer.transaction.payment', ['slug' => session('event_slug'), 'transaction_id' => session('transaction_id')]) }}"
                                class="btn text-white" style="background-color: #A103D3;">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <form id="bookTicketForm" action="{{ route('customer.transaction.processBooking', ['slug' => $event->slug]) }}"
        method="POST">@csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
        <div class="container" id="form1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center p-4"
                    style="background-color: #FAFAFA">
                    <h5 class="mb-0">Book Ticket</h5>
                    <a href=" {{ route('customer.home') }} " class="nav-link text-danger">Cancel Order</a>
                </div>
                <div class="card-body" style="background-color: #F5F0F6">
                    <h5>{{ $event->name }}</h5>
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="d-flex align-items-center mb-3">
                            <span><b>{{ $ticket->type }}</b></span>
                        </div>
                        <div class="d-flex align-items-center border-bottom">
                            <div>
                                <span>
                                    <h5 style="color: #A103D3">Rp {{ number_format($ticket->price, 0, ',', '.') }}</h5>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="d-flex align-items-center mb-3">
                            <span><b>DATE</b></span>
                        </div>
                        <div class="input-group">
                            <input type="date" name="validitydate" class="form-control" id="date"
                                style="color: #A103D3" min="{{ $event->start_event }}" max="{{ $event->end_event }}">
                            <i class="bi bi-calendar"></i>
                        </div>
                        @error('validitydate')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-body mb-4 border rounded" style="background-color: #FFFFFF">
                        <div class="d-flex align-items-center mb-3">
                            <span><b>TOTAL</b></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center ticket-selection border-bottom">
                            <span>{{ $ticket->type }}</span>
                            <div></div>
                            <div></div>
                            <div></div>
                            <span id="price1" class="text-center" style="color: #A103D3"><b>Rp
                                    {{ number_format($ticket->price, 0, ',', '.') }}</b></span>
                            <div class="quantity-control">
                                <button type="button" class="btn" onclick="decreaseQuantity()">-</button>
                                <input type="text" name="qty" id="qty" value="1" readonly>
                                <button type="button" class="btn" onclick="increaseQuantity()">+</button>

                            </div>
                        </div>
                        @error('qty')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5>Summary</h5>
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="d-flex justify-content-between border-bottom p-2">
                            <span><b>Date</b></span>
                            <span id="dateSpan">Ticket Date</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div>
                                <span id="totalQty1">Total Ticket (1x)</span>
                                <span>
                                    <h5 id="price2" style="color: #A103D3">
                                        Rp {{ number_format($ticket->price, 0, ',', '.') }} </h5>
                                </span>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    &#11161;
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pricing
                                                    Details</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6> {{ $event->name }} </h6>
                                                <div class="align-items-center p-1 mt-3 border"
                                                    style="background-color: #FAFAFA; border-radius: 20px">
                                                    <div class="p-2">
                                                        <p>Ticket type</p>
                                                    </div>
                                                    <div class="d-flex p-2 justify-content-between">
                                                        <h6>{{ $ticket->type }} (x1)</h6>
                                                        <h5 style="color: #A103D3">
                                                            Rp {{ number_format($ticket->price, 0, ',', '.') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="align-items-center p-1 mt-3 border"
                                                    style="background-color: #FAFAFA; border-radius: 20px">
                                                    <div class="p-2">
                                                        <p>Others Fees</p>
                                                    </div>
                                                    <div class="align-items-center border-3 border-bottom">
                                                        <div class="d-flex p-2 justify-content-between">
                                                            <h6>Tax</h6>
                                                            <h6>Include</h6>
                                                        </div>
                                                        <div class="d-flex p-2 justify-content-between">
                                                            <h6 id="totalQty2">Total Ticket</h6>
                                                            <h6 id="price3">
                                                                Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex p-2 justify-content-between">
                                                        <h6>Total Payment</h6>
                                                        <h5 id="price4" style="color: #A103D3">
                                                            Rp {{ number_format($ticket->price, 0, ',', '.') }} </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" style="background-color: #A103D3;  border-color: #A103D3;"
                            type="button" onclick="nextForm()">Next</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="container" id="form2" style="display: none">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center p-4"
                    style="background-color: #FEF6E5">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn " onclick="previousForm()">
                            < </button>
                                <h5 class="mb-0">Ticket Package</h5>
                    </div>
                </div>
                <div class="card-body" style="background-color: #FAFAFA">
                    <div class="p-3">
                        <h5>Your Contact</h5>
                        <p>Fill in this form correctly. We'll send the e-ticket to the email address as declared on this
                            page.</p>
                    </div>
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="mb-3">
                            <input type="text" name="contact_name" id="exampleFormControlInput1"
                                class="form-control mb-3" placeholder="Full Name">
                            @error('contact_name')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" name="contact_number" id="contactPhone"
                                class="form-control intl-tel-input mb-3" placeholder="Phone Number">
                            @error('contact_number')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" name="contact_email" class="form-control mb-3"
                                id="exampleFormControlInput1" placeholder="Email">
                            @error('contact_email')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="p-3">
                        <h5>Visitor Details</h5>
                        <p>Make sure to fill in the visitor details correctly for a smooth experience.</p>
                    </div>
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="border-bottom">
                            <div class="d-flex align-items-center p-2">
                                <span><b id="totalQty3">Total Ticket (1x)</b></span>
                            </div>
                            <div class="d-flex align-items-center p-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexRadioDefault2" onchange="toggleInputs()">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Same as contact details
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <div class="mb-2 align-item-center">
                                <div class="d-flex">
                                    <div>
                                        <p class="p-2"
                                            style="color: #D49600; background-color: #FCF6E8; border-radius: 25px;">
                                            You
                                            only
                                            need one visitor's info for all the tickets you book.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="visitor_name" id="visitorNameInput"
                                    class="form-control mb-3" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="visitor_number" id="visitorPhone"
                                    class="form-control intl-tel-input mb-3" placeholder="Phone Number">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="visitor_email" class="form-control mb-3"
                                    id="visitorEmailInput" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="identity_number" class="form-control mb-3"
                                    id="exampleFormControlInput1" placeholder="Identity Card Number">
                                @error('idetity_number')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                            <div class="d-flex justify-content-between p-2 border-bottom">
                                <span class="mb-2"><b>Total Payment</b></span>
                                <div class="d-flex align-items-center">
                                    <h5 id="price5" style="color: #A103D3">
                                        {{ number_format($ticket->price, 0, ',', '.') }}</h5>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2">
                                        &#11161;
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pricing
                                                        Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6> {{ $event->name }} </h6>
                                                    <div class="align-items-center p-1 mt-3 border"
                                                        style="background-color: #FAFAFA; border-radius: 20px">
                                                        <div class="p-2">
                                                            <p>Ticket type</p>
                                                        </div>
                                                        <div class="d-flex p-2 justify-content-between">
                                                            <h6>{{ $ticket->type }} (x1)</h6>
                                                            <h5 style="color: #A103D3">
                                                                {{ number_format($ticket->price, 0, ',', '.') }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center p-1 mt-3 border"
                                                        style="background-color: #FAFAFA; border-radius: 20px">
                                                        <div class="p-2">
                                                            <p>Others Fees</p>
                                                        </div>
                                                        <div class="align-items-center border-3 border-bottom">
                                                            <div class="d-flex p-2 justify-content-between">
                                                                <h6>Tax</h6>
                                                                <h6>Include</h6>
                                                            </div>
                                                            <div class="d-flex p-2 justify-content-between">
                                                                <h6 id="totalQty4">Total Ticket</h6>
                                                                <h6 id="price6">
                                                                    {{ number_format($ticket->price, 0, ',', '.') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex p-2 justify-content-between">
                                                            <h6>Total Payment</h6>
                                                            <h5 id="price7" style="color: #A103D3">
                                                                {{ number_format($ticket->price, 0, ',', '.') }} </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" style="background-color: #A103D3;  border-color: #A103D3;"
                                type="submit">Book
                                Ticket</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




    @include('customers.component.script')
    <script>
        function formatCurrency(value) {
            return 'Rp ' + value.toLocaleString('id-ID');
        }

        function updatePrice() {
            var price = parseFloat("{{ $ticket->price }}");
            var quantity = parseInt(document.getElementById('qty').value);
            var totalPrice = price * quantity;

            // Update all total quantity elements with the new quantity
            var totalQtyElements = document.querySelectorAll("[id^='totalQty']");
            for (var i = 0; i < totalQtyElements.length; i++) {
                totalQtyElements[i].innerHTML = "Total Ticket (" + quantity + "x)";
            }

            var formattedTotalPrice = formatCurrency(totalPrice);

            document.getElementById('price1').innerHTML = "<b>" + formattedTotalPrice + "</b>";
            document.getElementById('price2').innerHTML = "<b>" + formattedTotalPrice + "</b>";
            document.getElementById('price3').innerHTML = formattedTotalPrice;
            document.getElementById('price4').innerHTML = formattedTotalPrice;
            document.getElementById('price5').innerHTML = formattedTotalPrice;
            document.getElementById('price6').innerHTML = formattedTotalPrice;
            document.getElementById('price7').innerHTML = formattedTotalPrice;
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('qty');
            let qty = parseInt(quantityInput.value);
            if (qty > 1) {
                qty--;
                quantityInput.value = qty;
                updatePrice();
            }
        }

        function increaseQuantity() {
            const quantityInput = document.getElementById('qty');
            let qty = parseInt(quantityInput.value);
            if (qty < 4) {
                qty++;
                quantityInput.value = qty;
                updatePrice();
            }
        }


        function nextForm() {
            document.getElementById("form1").style.display = "none";
            document.getElementById("form2").style.display = "block";
        }

        function previousForm() {
            document.getElementById("form1").style.display = "block";
            document.getElementById("form2").style.display = "none";
        }

        function showLoader(event) {
            event.preventDefault();
            document.getElementById("loaderWrapper").style.display = "flex";
            setTimeout(() => {
                document.getElementById("loaderWrapper").style.display = "none";
                document.getElementById("bookingSuccess").style.display = "flex";
            }, 2000);
        }

        function submitForms() {
            document.getElementById("bookTicketForm").submit();
            document.getElementById("ticketPackageForm").submit();
        }

        function toggleInputs() {
            var radio = document.getElementById('flexRadioDefault2');
            var nameInput = document.getElementById('visitorNameInput');
            var phoneInput = document.getElementById('visitorPhone');
            var emailInput = document.getElementById('visitorEmailInput');

            if (radio.checked) {
                nameInput.disabled = true;
                phoneInput.disabled = true;
                emailInput.disabled = true;
            } else {
                nameInput.disabled = false;
                phoneInput.disabled = false;
                emailInput.disabled = false;
            }
        }

        function formatDate(date) {
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };
            return new Date(date).toLocaleDateString('en-GB', options).replace(/ /g, ' ');
        }

        document.getElementById('date').addEventListener('change', function() {
            const dateValue = this.value;
            if (dateValue) {
                const formattedDate = formatDate(dateValue);
                document.getElementById('dateSpan').innerHTML = `<b>${formattedDate}</b>`;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
    <script>
        // Initialize intl-tel-input for both phone inputs
        const contactPhoneInput = document.querySelector("#contactPhone");
        const visitorPhoneInput = document.querySelector("#visitorPhone");

        const contactPhone = window.intlTelInput(contactPhoneInput, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                fetch("https://ipinfo.io/json", {
                        headers: {
                            "Accept": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(json => success(json.country))
                    .catch(() => success("US"));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        const visitorPhone = window.intlTelInput(visitorPhoneInput, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                fetch("https://ipinfo.io/json", {
                        headers: {
                            "Accept": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(json => success(json.country))
                    .catch(() => success("US"));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
    </script>
</body>

</html>
