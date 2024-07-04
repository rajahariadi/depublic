@extends('customers.component.head')

<body>
    <style>
        @media (max-width: 767px) {
            .payment-method a {
                color: #A103D3;
                border-color: #A103D3;
            }
        }
    </style>
    @include('customers.component.navbar')


    @section('midtrans')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('{{ $transaction->snap_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        window.location.href =
                            '{{ route('customer.transactions.success', ['transaction_id' => $transaction->id]) }}'
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        window.location.href =
                            '{{ route('customer.transactions.failed', ['transaction_id' => $transaction->id]) }}'
                    }
                });
            };
        </script>
    @endsection

    <div class="container">
        <div class="card">
            <div class="card-body" style="background-color: #FAFAFA">
                <div class="card-body border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex justify-content-between p-2 align-items-center">
                        <h5>Complete payment in</h5>
                        <div id="timer" class="ms-3 p-2 rounded"
                            style="background-color: #FCF6E8; border-radius: 20px">
                            <span style="color: #D49600" id="countdown"
                                data-due-time="{{ $transaction->payment_due_time }}"></span>
                        </div>
                    </div>
                </div>

                <div class="card-body mb-3 mt-5 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex justify-content-between align-items-center p-2 mt-3">
                        <h5>Payment Instructions</h5>
                        <div class="p-2 border" style="background-color: #FAFAFA; border-radius: 10px">
                            <span>Complete before</span><br>
                            <span><b>{{ \Carbon\Carbon::parse($transaction->payment_due_time)->format('l, d F Y H:i') }}
                                    GMT+9</b></span>
                        </div>
                    </div>
                    <h6 class="p-2">Total Payment</h6>
                    <div class="d-flex align-items-center p-3 mt-3 mb-3 border" style=" border-radius: 20px">
                        <span>IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                    <h6 class="p-2">Payment Method</h6>
                    <div class="d-flex justify-content-between align-items-center p-3 mt-3 mb-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <span>Transfer via ATM</span>
                        <button class="btn">&or;</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 mt-3 mb-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <span>Transfer via Internet Banking</span>
                        <button class="btn">&or;</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 mt-3 mb-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <span>Transfer via Mobile Banking</span>
                        <button class="btn">&or;</button>
                    </div>
                    <div class="d-flex align-items-center p-3 mt-3 mb-3 border"
                        style="background-color: #FCF6E8; border-radius: 20px">
                        <div style="color: #D49600">
                            <i class="fa-solid fa-circle-info me-2"></i>
                            <span> Once our payment is verified, your e-ticket and receipt will be sent to the
                                registered email address</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn w-100" style="color: #A103D3; border-color:#A103D3;"
                            onclick="window.location.href='{{ route('customer.transaction.payment', ['slug' => $transaction->ticket->event->slug, 'transaction_id' => $transaction->id]) }}' ">
                            Change Payment Method</button>
                        <button class="w-100 btn ms-1 text-white" style="background-color: #A103D3;"
                            onclick="window.location.href='{{ route('customer.transactions.history') }}' ">
                            See Order List</button>
                    </div>
                </div>
                <div class="card-body border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex p-2 align-items-center">
                        <p class="p-2" style="color: #D49600; background-color: #FCF6E8; border-radius: 25px;">Order
                            ID: {{ $transaction->id }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom"
                        style="border-bootom-style: dashed;">
                        <div class="d-flex align-items-center">
                            <img class="me-3" src="{{ asset('assets/ticket.png') }}" alt="Ticket Icon" width="40"
                                height="40">
                            <div>
                                <span class="d-block fw-bold">{{ $transaction->ticket->event->name }}</span>
                                <span>{{ $transaction->validitydate }}</span>
                            </div>
                        </div>
                        <button class="btn">&or;</button>
                    </div>
                    <div class="d-flex justify-content-between p-2 mt-3">
                        <h5>Total Payment</h5>
                        <div class="d-flex align-items-center">
                            <h5 style="color: #A103D3">IDR {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn mb-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                &or;
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pricing Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>{{ $transaction->ticket->event->name }}</h6>
                                            <div class="align-items-center p-1 mt-3 border"
                                                style="background-color: #FAFAFA; border-radius: 20px">
                                                <div class="p-2">
                                                    <p>Ticket type</p>
                                                </div>
                                                <div class="d-flex p-2 justify-content-between">
                                                    <h6>{{ $transaction->ticket->type }} (X{{ $transaction->qty }})
                                                    </h6>
                                                    <h5 style="color: #A103D3">IDR
                                                        {{ number_format($transaction->ticket->price, 0, ',', '.') }}
                                                    </h5>
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
                                                        <h6>Transaction fee</h6>
                                                        <h6>IDR
                                                            {{ number_format($transaction->ticket->price, 0, ',', '.') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex p-2 justify-content-between">
                                                    <h6>Total Payment</h6>
                                                    <h5 style="color: #A103D3">IDR
                                                        {{ number_format($transaction->total_price, 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="pay-button" class="btn btn-primary fw-bold fs-5"
                            style="background-color: #A103D3; border-color: #A103D3;">Pay
                            Now</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customers.component.script')
    <script>
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
