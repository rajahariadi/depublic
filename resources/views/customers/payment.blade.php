@include('customers.component.head')

<body>
    <style>
        .container {
            max-width: 575px;
            padding: 20px;
        }

        .recommended {
            background-color: #e0f7e8;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .payment-method,
        .your-ticket {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .centered-div {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #D49600;
            background-color: #FCF6E8;
            height: 55px;
            width: 55px;
            border-radius: 50%;
        }

        .img-right-arrow {
            cursor: pointer;
            width: 6.5px;
            height: 13px;
        }

        .img-bottom-arrow {
            width: 13px;
            height: 6.5px;
        }

        .img-up-arrow {
            width: 13px;
            height: 6.5px;
            margin-bottom: -10px;
            vertical-align: middle;
        }

        .img-ticket-icon {
            height: 22.39px;
            width: 35.79px;
        }

        .img-promo-icon {
            height: 24px;
            width: 24px;
        }

        .img-point-icon {
            height: 24px;
            width: 24px;
        }

        .img-bank-icon {
            height: 25px;
            width: 25px;
            margin-right: 10px;
        }

        .img-close {
            cursor: pointer;
            height: 30px;
            width: 30px;
            margin-right: 10px;
        }

        .img-info-icon {
            height: 20px;
            width: 20px;
            margin-bottom: 2px
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .toggle-switch label {
            margin: 0;
        }

        .total-payment {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        .total-amount {
            margin-right: -120px;
            color: #8a2be2;
        }

        .terms {
            margin-top: 1rem;
            font-size: 1rem;
        }

        .terms a {
            color: #8a2be2;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .bank-btn {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: black;
            text-decoration: none;
        }

        .timer {
            font-size: 1.5rem;
            font-weight: bold;
        }

        #timer {
            background-color: #FBF6EC;
        }

        .modal {
            max-width: 575px;
            padding: 20px;
            display: none;
            position: fixed;
            top: 90%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            overflow: auto;
            justify-content: center
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 575px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .blur {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }
    </style>
    @include('customers.component.navbar')


    <form action="{{ route('customer.transaction.processPayment', $transaction->id) }}" method="POST">
        @csrf
        <div class="container" id="form1">
            <div class="card justify-content-center d-flex">
                <div class="card-body" style="background-color: #FAFAFA">
                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div id="countdown-timer" class="d-flex align-items-center justify-content-between w-100">
                            <p class="fw-bold fs-5 mt-2 mb-2">Complete payment in</p>
                            <div id="timer" class="ms-3 p-2 rounded">
                                <span id="countdown" data-due-time="{{ $transaction->payment_due_time }}"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <div class="d-flex align-items-center mb-3 border-bottom">
                            <span class="fs-5 mb-3"><b>Payment Method</b></span>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold mb-3">Select Payment Method</p>
                                <img class="img-right-arrow mb-3" src="{{ asset('assets/images/right-arrow.png') }}"
                                    alt="Right Arrow" onclick="nextForm()">
                            </div>
                            <div class="mb-2 align-item-center">
                                <div class="d-flex">
                                    <div>
                                        <p class="p-2 px-3 fs-6"
                                            style="color: #0B640D; background-color: #EAF2E2; border-radius: 25px;">
                                            Recommended</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="mandiri">
                                <label class="form-check-label mb-3" for="mandiri">Mandiri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="bca">
                                <label class="form-check-label mb-3" for="bca">BCA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="qris">
                                <label class="form-check-label" for="qris">QRIS</label>
                            </div>
                            @error('payment_method')
                                <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                        <p class="fw-bold fs-5">Your Ticket</p>
                        <div class="mt-2 align-item-center">
                            <div class="d-flex justify-content-center">
                                <p class="p-2 px-5 text-center"
                                    style="color: #D49600; background-color: #FCF6E8; border-radius: 25px; width: 440px;">
                                    Order ID:{{ $transaction->id }}</p>
                            </div>
                        </div>
                        <div class="your-ticket mb-4 p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle centered-div">
                                        <img class="img-ticket-icon" src="{{ asset('assets/images/ticket-icon.png') }}"
                                            alt="ticket-icon">
                                    </div>
                                    <div style="margin-left: 4px;">
                                        <p style="margin-bottom: 0px">
                                            {{ $transaction->ticket->event->name }}<br>
                                            {{ $transaction->validitydate }}
                                        </p>
                                    </div>
                                </div>
                                <img class="img-bottom-arrow mb-3" src="{{ asset('assets/images/bottom-arrow.png') }}"
                                    alt="Bottom Arrow">
                            </div>
                            <div class="mt-4">
                                <div class="toggle-switch">
                                    <label for="promos-toggle" class="form-label d-flex align-items-center">
                                        <img class="img-promo-icon" src="{{ asset('assets/images/promo-icon.png') }}"
                                            alt="Promo icon">
                                        <span class="ms-2">See promos/vouchers</span>
                                    </label>
                                    <input type="checkbox" id="promos-toggle" class="form-check-input">
                                </div>
                                <div class="toggle-switch">
                                    <label for="points-toggle" class="form-label d-flex align-items-center">
                                        <img class="img-point-icon" src="{{ asset('assets/images/point-icon.png') }}"
                                            alt="Point icon">
                                        <span class="ms-2">Use 0 points</span>
                                    </label>
                                    <input type="checkbox" id="points-toggle" class="form-check-input">
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="total-payment fs-5">
                                    <span>Total Payment</span>
                                    <span class="total-amount">
                                        {{ number_format($transaction->total_price, 0, ',', '.') }} </span>
                                    <img class="img-up-arrow mb-1" src="{{ asset('assets/images/up-arrow.png') }}"
                                        alt="Up Arrow">
                                </div>
                                <div class="terms">
                                    dengan melanjutkan proses pembayaran, kamu menyetujui <a href="#">Syarat &
                                        Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> depublic.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary fw-bold fs-5"
                            style="background-color: #A103D3; border-color: #A103D3;" type="submit">Continue
                            Payment</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="form2" style="display: none">
            <div class="card justify-content-center d-flex" style="border: none;">
                <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex align-items-center mb-3 border-bottom">
                        <span class="fs-4 mb-3"><b>Select Payment Method</b></span>
                        <img class="img-close" src="{{ asset('assets/images/close.png') }}"
                            style="margin-left: auto; margin-top: -15px;" onclick="previousForm()">
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-5 fw-bold">Virtual Account</h5>
                                <p style="font-size: 15px;">
                                    You can pay by transferring via ATM, Internet Banking & Mobile
                                    Banking.
                                </p>
                                <div class="d-flex flex-wrap">
                                    <a href="#" class="bank-btn ml-n1">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="fs-5 fw-bold">E-Wallet</h5>
                                <p>
                                    Pay instantly with a digital wallet on your smartphone, pay from
                                    anywhere is possible.
                                </p>
                                <div class="d-flex flex-wrap">
                                    <a href="#" class="bank-btn ml-n1">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                </div>
                                <div class="mt-4 align-item-center">
                                    <div class="d-flex">
                                        <div>
                                            <p class="p-2"
                                                style="color: #D49600; background-color: #FCF6E8; border-radius: 25px; font-size: 14px;">
                                                <img class="img-info-icon"
                                                    src="{{ asset('assets/images/info-icon.png') }}" alt="Info Icon">
                                                There are payment methods that are currently unavailable
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="fs-5 fw-bold">Instant Payment</h5>
                                <p>
                                    Pay instantly with a digital wallet on your smartphone, pay from
                                    anywhere is possible.
                                </p>
                                <div class="d-flex flex-wrap">
                                    <a href="#" class="bank-btn ml-n1">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                    <a href="#" class="bank-btn mx-2">
                                        <img class="img-bank-icon" src="{{ asset('assets/images/bca-logo.png') }}"
                                            alt="Bank Icon">
                                        Bank BCA
                                    </a>
                                </div>
                                <div class="mt-4 align-item-center">
                                    <div class="d-flex">
                                        <div>
                                            <p class="p-2"
                                                style="color: #D49600; background-color: #FCF6E8; border-radius: 25px; font-size: 14px;">
                                                <img class="img-info-icon"
                                                    src="{{ asset('assets/images/info-icon.png') }}" alt="Info Icon">
                                                There are payment methods that are currently unavailable
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal" id="promo-popup">
        <div class="card justify-content-center d-flex" style="border: none;">
            <div class="card-body border rounded" style="background-color: #FFFFFF">
                <div class="d-flex align-items-center mb-3 border-bottom">
                    <span class="fs-4 mb-3"><b>Promo & Voucer Code</b></span>
                    <img class="img-close" id="img-close" src="{{ asset('assets/images/close.png') }}"
                        style="margin-left: auto; margin-top: -15px;">
                </div>
                <div class="mb-0 d-flex align-item-end">
                    <input placeholder="Enter Your Code" type="text" class="form-control w-75 rounded-3 "
                        id="username" name="username" required
                        style="background: transparent; solid #A6A6A6; position: relative; z-index: 1; width: 328px; height: 34px;">
                    <button type="submit" class="ms-3 pb-1 rounded-3 text-center text-light"
                        style="background-color: #A103D3;  border: none; width: 137px; height: 34px;">Apply</button>
                </div>
            </div>
        </div>
    </div>


    @include('customers.component.script')
    <script>
        function nextForm() {
            document.getElementById("form1").style.display = "none";
            document.getElementById("form2").style.display = "block";
        }

        function previousForm() {
            document.getElementById("form2").style.display = "none";
            document.getElementById("form1").style.display = "block";
        }

        function showModal() {
            document.getElementById("promo-popup").style.display = "block";
            document.getElementById("form1").classList.add("blur");
        }

        function hideModal() {
            document.getElementById("promo-popup").style.display = "none";
            document.getElementById("form1").classList.remove("blur");
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the toggle switch
            document.getElementById('promos-toggle').addEventListener('click', showModal);
            // Add event listener to the close button
            document.getElementById('img-close').addEventListener('click', hideModal);
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            // Ambil elemen dan data due time
            const countdownElement = document.getElementById('countdown');
            const dueTime = countdownElement.getAttribute('data-due-time');

            // Konversi dueTime ke dalam waktu milidetik
            const countDownDate = new Date(dueTime).getTime();

            // Update countdown setiap detik
            const countdownFunction = setInterval(() => {
                // Dapatkan waktu sekarang
                const now = new Date().getTime();

                // Temukan jarak antara sekarang dan waktu jatuh tempo
                const distance = countDownDate - now;

                // Kalkulasi waktu untuk hari, jam, menit, dan detik
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Tampilkan hasil dalam elemen countdown
                countdownElement.innerHTML = `${hours} : ${minutes} : ${seconds}`;

                // Jika hitungan mundur selesai, tulis teks
                if (distance < 0) {
                    clearInterval(countdownFunction);
                    countdownElement.innerHTML = "EXPIRED";
                }
            }, 1000);
        });
    </script>
</body>


</html>
