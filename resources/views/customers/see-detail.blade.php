@include('customers.component.head')

<body>
    <style>
        .container {
            max-width: 575px;
            padding: 20px;
        }

        .custom-button {
            color: #D081E9;
            /* Warna teks */
            background-color: #fff;
            /* Warna latar belakang */
            border-color: #D081E9;
            /* Warna border */
        }

        .custom-button:hover {
            color: #fff;
            background-color: #A103D3;
            border-color: #D081E9;
        }
    </style>

    @include('customers.component.navbar')
    <div class="container">
        <div class="card">
            <div class="card-body" style="background-color: #FAFAFA">
                <div class="d-flex p-3">
                    <p class="me-2 text-secondary">Complete Payment</p>
                    <p class="me-2 text-secondary"> > </p>
                    <p class="me-2 text-secondary">Pick an Action</p>
                    <p class="me-2 text-secondary">></p>
                    <p class="me-2" style="color: #A103D3">See Detail</p>
                </div>
                <div class="card-body mb-3 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex justify-content-between border-bottom p-2">
                        <h5> {{ $transaction->ticket->event->name }} </h5>
                        <p class="p-2" style="color: #D49600; background-color: #FCF6E8; border-radius: 25px;">
                            Order ID : {{ $transaction->id }} </p>
                    </div>
                    <div class="d-flex justify-content-between p-2 mt-3">
                        <span class="mb-2"><b>Total Payment</b></span>
                        <div class="d-flex align-items-center">
                            <h5 style="color: #A103D3"> IDR {{ number_format($transaction->total_price, 0, ',', '.') }}
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
                                            <h6> {{ $transaction->ticket->event->name }} </h6>
                                            <div class="align-items-center p-1 mt-3 border"
                                                style="background-color: #FAFAFA; border-radius: 20px">
                                                <div class="p-2">
                                                    <p>Ticket type</p>
                                                </div>
                                                <div class="d-flex p-2 justify-content-between">
                                                    <h6> {{ $transaction->ticket->type }} (x{{ $transaction->qty }})
                                                    </h6>
                                                    <h5 style="color: #A103D3"> IDR
                                                        {{ number_format($transaction->total_price, 0, ',', '.') }}</h5>
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
                                                            {{ number_format($transaction->total_price, 0, ',', '.') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex p-2 justify-content-between">
                                                    <h6>Total Payment</h6>
                                                    <h5 style="color: #A103D3"> IDR
                                                        {{ number_format($transaction->total_price, 0, ',', '.') }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        @if ($transaction->status == 'success')
                            <button class="btn text-white btn-success" style="" type="button"><b>Payment
                                    Successfully</b></button>
                        @elseif ($transaction->status == 'pending')
                            <a href="{{ route('customer.transaction.payment', ['slug' => $transaction->ticket->event->slug, 'transaction_id' => $transaction->id]) }}"
                                class="btn" style="color: #A103D3;  border-color: #A103D3;"><b>Continue
                                    Payment</b></a>
                        @endif
                    </div>
                </div>

                <div class="card-body mb-3 mt-5 border rounded" style="background-color: #FFFFFF">
                    <div class="d-flex align-items-center p-2 mt-3">
                        <span><b>Events</b></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 mt-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <div class="p-2">
                            <span class="">Booking code</span>
                            <span>
                                <p> {{$transaction->code}} </p>
                            </span>
                        </div>
                        <button class="btn  text-white" style="background-color: #60D13A">Booked</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 mt-3 border-bottom border-2 ">
                        <div class="p-2 border-2 border-end" style="">
                            <img src="{{ Storage::url($transaction->ticket->event->image) }}" alt="{{$transaction->ticket->event->name}}" width="200px" height="100px">
                        </div>
                        <div class="p-2">
                            <span>
                                <h5>
                                   {{$transaction->ticket->event->name}}
                                </h5>
                            </span>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-location-dot me-2" style="color: #A103D3"></i>
                                {{$transaction->ticket->event->location}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-3 mt-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <div class="p-2">
                            <p>Ticket type</p>
                            <h6>{{ $transaction->ticket->type }} (x{{ $transaction->qty }})</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-3 mt-3 border"
                        style="background-color: #FAFAFA; border-radius: 20px">
                        <div class="p-2">
                            <p>Validity date</p>
                            <h6>Valid on {{$transaction->validitydate}} </h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-3 mt-3 border"
                        style="background-color: #F5F0F6; border-radius: 20px">
                        <div class="p-2">
                            <p>{{Auth::user()->name}}</p>
                            <h6> {{$transaction->ticket->type}} </h6>
                        </div>
                    </div>
                    <div class="align-items-center p-3 mt-3 border"
                        style="background-color: #FBF6EC; border-radius: 20px">
                        <div class="p-2 mb-2">
                            <span><b>Info Penting</b></span>
                        </div>
                        <ul>
                            <li>
                                <p>FEARNOT MEMBERSHIP PRESALE dimulai pada hari Kamis, 3 Agustus 2023 pukul 12.00 -
                                    22.00 WIB.</p>
                            </li>
                            <li>
                                <p>General Sales dimulai pada hari Jumat, 4 Agustus 2023 pukul 12.00 WIB.</p>
                            </li>
                            <li>
                                <p>Untuk Presale, 1 (satu) akun hanya dapat membeli maks. 4 (empat) tiket.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-2">
                    <h5>Location</h5>
                </div>
                <div class="align-items-center text-center">
                    <img class="img-fluid" src="{{ asset('assets/location.png') }}" alt="location">
                </div>
            </div>
        </div>
    </div>

    @include('customers.component.script')
</body>

</html>
